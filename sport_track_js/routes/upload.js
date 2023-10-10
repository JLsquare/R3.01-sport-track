const express = require('express');
const router = express.Router();
const { user_dao, activity_dao, activity_entry_dao } = require('sport-track-db');
const multer = require('multer');
const { calculDistanceTrajet: calculateDistance } = require('../utils/functions');

const storage = multer.memoryStorage();
const upload = multer({ storage: storage });

/**
 * GET /upload
 * Display the upload page.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.get('/', (req, res, next) => {
    const { email, password } = req.session;

    if (!email || !password) {
        return res.render('index', {error: "Pas de session ouverte."});
    }

    user_dao.findByEmailAndPassword(email, password, (err, user) => {
        if (err) {
            console.error(err);
            return next(err);
        }

        if (user) {
            return res.render('upload', { user });
        }

        res.render('index', {error: "Identifiants de session incorrects."});
    });
});

/**
 * POST /upload
 * Handle the upload page form.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.post('/', upload.single('file'), (req, res, next) => {
    const { email, password } = req.session;

    if (!email || !password) {
        return res.render('index', { error: 'No session open.' });
    }

    if (!req.file || !req.file.buffer) {
        return res.render('upload', { error: 'Pas de fichier importer' });
    }

    try {
        const data = JSON.parse(req.file.buffer.toString());

        if (!data.activity || !data.data) {
            return res.render('upload', { error: 'Format de fichier invalide.' });
        }

        activity_dao.getLastId((err, lastId) => {
            if (err) {
                console.error(err);
                return next(err);
            }

            const activityId = lastId;
            const entries = data.data;
            const distance = calculateDistance(entries);
            const duration = (new Date(`1970-01-01T${entries[entries.length - 1].time}Z`) - new Date(`1970-01-01T${entries[0].time}Z`)) / 1000;
            let cardioFrequencyMin = entries[0].cardio_frequency;
            let cardioFrequencyMax = cardioFrequencyMin;
            let cardioFrequencySum = 0;

            entries.forEach(entry => {
                const activityEntry = {
                    activityId: activityId,
                    dateTime: entry.time,
                    cardioFrequency: entry.cardio_frequency,
                    latitude: entry.latitude,
                    longitude: entry.longitude,
                    altitude: entry.altitude
                };

                cardioFrequencyMin = Math.min(cardioFrequencyMin, entry.cardio_frequency);
                cardioFrequencyMax = Math.max(cardioFrequencyMax, entry.cardio_frequency);
                cardioFrequencySum += entry.cardio_frequency;

                activity_entry_dao.insert(activityEntry, err => {
                    if (err) console.error(err);
                });
            });

            const activity = {
                activityId,
                userEmail: email,
                activityDate: data.activity.date,
                startTime: entries[0].time,
                endTime: entries[entries.length - 1].time,
                duration,
                description: data.activity.description,
                distance,
                cardioFrequencyMin,
                cardioFrequencyMax,
                cardioFrequencyAverage: cardioFrequencySum / entries.length
            };

            activity_dao.insert(activity, err => {
                if (err) console.error(err);
            });

            res.render('upload', { success: 'Fichier importé avec succès.' });
        });
    } catch (error) {
        res.render('upload', { error: 'Erreur pendant l\'importation du fichier', errorLog: error });
    }
});

module.exports = router;