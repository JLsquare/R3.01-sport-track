const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('./db/sport_track.db');

module.exports = db;
