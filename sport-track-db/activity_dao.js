const db = require('./sqlite_connection');

/**
 * Data Access Object for activities.
 * @class
 */
const ActivityDAO = function() {
    /**
     * Inserts a new activity into the database.
     * @param {Object} activity - The activity to be inserted.
     * @param {Function} callback - A callback function to be called after insertion.
     */
    this.insert = function(activity, callback) {
        const query = `INSERT INTO Activities(userEmail, activityDate, startTime, endTime, duration, description, distance, cardioFrequencyMin, cardioFrequencyMax, cardioFrequencyAverage) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;
        db.run(query, [activity.userEmail, activity.activityDate, activity.startTime, activity.endTime, activity.duration, activity.description, activity.distance, activity.cardioFrequencyMin, activity.cardioFrequencyMax, activity.cardioFrequencyAverage], callback);
    };

    /**
     * Updates an existing activity in the database.
     * @param {Object} activity - The activity with updated fields.
     * @param {Function} callback - A callback function to be called after updating.
     */
    this.update = function(activity, callback) {
        const query = `UPDATE Activities SET userEmail = ?, activityDate = ?, startTime = ?, endTime = ?, duration = ?, description = ?, distance = ?, cardioFrequencyMin = ?, cardioFrequencyMax = ?, cardioFrequencyAverage = ? WHERE activityId = ?`;
        db.run(query, [activity.userEmail, activity.activityDate, activity.startTime, activity.endTime, activity.duration, activity.description, activity.distance, activity.cardioFrequencyMin, activity.cardioFrequencyMax, activity.cardioFrequencyAverage, activity.activityId], callback);
    };

    /**
     * Deletes an activity from the database.
     * @param {Object} activity - The activity to be deleted.
     * @param {Function} callback - A callback function to be called after deletion.
     */
    this.delete = function(activity, callback) {
        const query = `DELETE FROM Activities WHERE activityId = ?`;
        db.run(query, [activity.activityId], callback);
    };

    /**
     * Fetches all activities from the database.
     * @param {Function} callback - A callback function to handle the fetched activities.
     */
    this.findAll = function(callback) {
        const query = "SELECT * FROM Activities";
        db.all(query, [], callback);
    };

    /**
     * Fetches an activity by its key from the database.
     * @param {number} key - The unique key of the activity.
     * @param {Function} callback - A callback function to handle the fetched activity.
     */
    this.findByKey = function(key, callback){
        const query = "SELECT * FROM Activities WHERE activityId = ?";
        db.get(query, [key], callback);
    };

    /**
     * Fetches all activities of a specific user.
     * @param {string} userEmail - The email of the user.
     * @param {Function} callback - A callback function to handle the fetched activities.
     */
    this.findAllFromUser = function(userEmail, callback) {
        const query = "SELECT * FROM Activities WHERE userEmail = ?";
        db.all(query, [userEmail], callback);
    };

    /**
     * Fetches the last activity ID from the database.
     * @param {Function} callback - A callback function to handle the last ID.
     */
    this.getLastId = function(callback) {
        const query = "SELECT seq FROM sqlite_sequence WHERE name='Activities'";
        db.get(query, [], function(err, row) {
            if (err) {
                callback(err);
            } else {
                callback(null, row ? row.seq + 1 : 1);
            }
        });
    };
};

const dao = new ActivityDAO();
module.exports = dao;
