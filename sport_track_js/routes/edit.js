const express = require('express');
const router = express.Router();
const { user_dao } = require('sport-track-db');

/**
 * GET /edit
 * Display the edit page.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.get('/', (req, res, next) => {
    const { email, password } = req.session;

    if (!email || !password) return res.redirect('/');

    user_dao.findByEmailAndPassword(email, password, (err, user) => {
        if (err) {
            console.error(err);
            return next(err);
        }

        if (user) {
            return res.render('edit', { user });
        }

        res.redirect('/');
    });
});

/**
 * POST /edit
 * Handle the edit page form.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.post('/', (req, res, next) => {
    const { email, password } = req.session;

    if (!email || !password) return res.redirect('/');

    user_dao.findByEmailAndPassword(email, password, (err, user) => {
        if (err) {
            console.error(err);
            return next(err);
        }

        if (!user) return res.redirect('/edit');

        if (req.body.action === 'save') {
            let newUser = {
                email: req.session.email,
                password: req.body.password ? req.body.password : req.session.password,
                firstName: req.body.firstName,
                lastName: req.body.lastName,
                birthdate: req.body.birthdate,
                gender: req.body.gender,
                weight: req.body.weight,
                height: req.body.height
            }

            user_dao.update(newUser, err => {
                if (err) {
                    console.error(err);
                    return next(err);
                }
                res.redirect('/panel');
            });
        } else if (req.body.action === 'delete') {
            user_dao.delete(user, err => {
                if (err) {
                    console.error(err);
                    return next(err);
                }
                req.session.destroy();
                res.redirect('/');
            });
        }
    });
});

module.exports = router;