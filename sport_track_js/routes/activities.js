const express = require('express');
const router = express.Router();
const { user_dao, activity_dao, activity_entry_dao } = require('sport-track-db');

/**
 * GET /activities
 * Display the activities page.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.get('/', (req, res, next) => {
    if (!req.session.email || !req.session.password) {
        return res.render('index', {error: "Pas de session ouverte."});
    }

    user_dao.findByEmailAndPassword(req.session.email, req.session.password, (err, user) => {
        if (err) {
            console.error(err);
            return next(err);
        }

        if (!user) {
            return res.render('index', {error: "Identifiants de session incorrects."});
        }

        activity_dao.findAllFromUser(user.email, (err, activities) => {
            if (err) {
                console.error(err);
                return next(err);
            }

            if (!activities.length) {
                return res.render('activities', {activities: []});
            }

            let activitiesWithEntries = [];
            activities.forEach(activity => {
                activity_entry_dao.findAllFromActivity(activity.activityId, (err, data) => {
                    if (err) {
                        console.error(err);
                        return next(err);
                    }

                    activity.entries = data;
                    activitiesWithEntries.push(activity);

                    if (activitiesWithEntries.length === activities.length) {
                        res.render('activities', {activities: activitiesWithEntries});
                    }
                });
            });
        });
    });
});

/**
 * POST /activities
 * Handle the activities page form.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.post('/', (req, res, next) => {
    if (req.body.delete_activity) {
        activity_dao.findByKey(req.body.delete_activity, (err, activity) => {
            if (err) {
                console.error(err);
                return next(err);
            }

            activity_dao.delete(activity, err => {
                if (err) {
                    console.error(err);
                    return next(err);
                }
                res.redirect('/activities');
            });
        });
    } else if (req.body.delete_activity_entry) {
        activity_entry_dao.findByKey(req.body.delete_activity_entry, (err, activityEntry) => {
            if (err) {
                console.error(err);
                return next(err);
            }

            activity_entry_dao.delete(activityEntry, err => {
                if (err) {
                    console.error(err);
                    return next(err);
                }
                res.redirect('/activities');
            });
        });
    }
});

module.exports = router;
