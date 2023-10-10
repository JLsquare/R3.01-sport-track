const express = require('express');
const router = express.Router();
const { user_dao } = require('sport-track-db');

/**
 * GET /panel
 * Display the panel page.
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
            return res.render('panel', { user });
        }

        res.render('index', {error: "Identifiants de session incorrects."});
    });
});

module.exports = router;
