const express = require('express');
const router = express.Router();
const { user_dao } = require('sport-track-db');

/**
 * GET /register
 * Display the register page.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.get('/', (req, res) => {
    res.render('register');
});

/**
 * POST /register
 * Register a new user.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.post('/', (req, res, next) => {
    const userObj = {
        email: req.body.email,
        password: req.body.password,
        firstName: req.body.firstName,
        lastName: req.body.lastName,
        birthdate: req.body.birthdate,
        gender: req.body.gender,
        height: req.body.height,
        weight: req.body.weight
    };

    user_dao.insert(userObj, err => {
        if (err) {
            console.error(err);
            return next(err);
        }

        res.redirect('/');
    });
});

module.exports = router;
