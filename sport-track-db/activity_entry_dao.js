const db = require('./sqlite_connection');

/**
 * Data Access Object for activity entries.
 * @class
 */
const ActivityEntryDAO = function() {
    /**
     * Fetches all activity entries from the database.
     * @param {Function} callback - A callback function to handle the fetched entries.
     */
    this.findAll = function(callback) {
        const query = "SELECT * FROM Data";
        db.all(query, [], callback);
    };

    /**
     * Fetches all entries for a specific activity from the database.
     * @param {number} activityId - The unique ID of the activity.
     * @param {Function} callback - A callback function to handle the fetched entries.
     */
    this.findAllFromActivity = function(activityId, callback) {
        const query = "SELECT * FROM Data WHERE activityId = ?";
        db.all(query, [activityId], callback);
    };

    /**
     * Inserts a new activity entry into the database.
     * @param {Object} entry - The activity entry to be inserted.
     * @param {Function} callback - A callback function to be called after insertion.
     */
    this.insert = function(entry, callback) {
        const query = "INSERT INTO Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude) values (?, ?, ?, ?, ?, ?)";
        db.run(query, [entry.activityId, entry.dateTime, entry.cardioFrequency, entry.latitude, entry.longitude, entry.altitude], callback);
    };

    /**
     * Deletes an activity entry from the database.
     * @param {Object} entry - The activity entry to be deleted.
     * @param {Function} callback - A callback function to be called after deletion.
     */
    this.delete = function(entry, callback) {
        const query = "DELETE FROM Data WHERE dataId = ?";
        db.run(query, [entry.dataId], callback);
    };

    /**
     * Updates an existing activity entry in the database.
     * @param {Object} entry - The activity entry with updated fields.
     * @param {Function} callback - A callback function to be called after updating.
     */
    this.update = function(entry, callback) {
        const query = "UPDATE Data SET activityId = ?, dataTime = ?, cardioFrequency = ?, latitude = ?, longitude = ?, altitude = ? WHERE dataId = ?";
        db.run(query, [entry.activityId, entry.dateTime, entry.cardioFrequency, entry.latitude, entry.longitude, entry.altitude, entry.id], callback);
    };

    /**
     * Fetches an activity entry by its key from the database.
     * @param {number} dataId - The unique ID of the activity entry.
     * @param {Function} callback - A callback function to handle the fetched entry.
     */
    this.findByKey = function(dataId, callback) {
        const query = "SELECT * FROM Data WHERE dataId = ?";
        db.get(query, [dataId], callback);
    };
};

const dao = new ActivityEntryDAO();
module.exports = dao;
