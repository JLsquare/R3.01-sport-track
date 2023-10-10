const express = require('express');
const router = express.Router();

/**
 * GET /apropos
 * Display the about page
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.get('/', function (req, res, next) {
    res.render('apropos');
});

module.exports = router;