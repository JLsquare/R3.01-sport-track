const express = require('express');
const router = express.Router();

/**
 * GET /disconnect
 * Display the disconnect page and destroy the session.
 * @param {Request} req
 * @param {Response} res
 * @param {NextFunction} next
 * @returns {void}
 */
router.get('/', function(req, res, next) {
    req.session.destroy();
    res.render('disconnect');
});

module.exports = router;