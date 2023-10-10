const express = require('express');
const router = express.Router();
const { user_dao } = require('sport-track-db');

/**
 * GET / (connect page)
 * Display the connect page (index).
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.get('/', (req, res) => {
    res.render('index');
});

/**
 * POST / (connect page)
 * Handle the connect page form.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.post('/', (req, res, next) => {
    user_dao.findByEmailAndPassword(req.body.email, req.body.password, (err, user) => {
        if (err) {
            console.error(err);
            return next(err);
        }

        if (user) {
            req.session.email = req.body.email;
            req.session.password = req.body.password;
            res.redirect('/panel');
        } else {
            res.render('index', {error: "Email or password incorrect"});
        }
    });
});

module.exports = router;
