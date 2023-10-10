const db = require('./sqlite_connection');
const bcrypt = require('bcrypt');

/**
 * Data Access Object for users.
 * @class
 */
const UserDAO = function() {
    /**
     * Inserts a new user into the database.
     * @param {Object} user - The user to be inserted. Contains email, password, firstName, lastName, birthdate, gender, height, weight.
     * @param {Function} callback - A callback function to be called after insertion.
     */
    this.insert = function(user, callback) {
        const hash = bcrypt.hashSync(user.password, 10);
        const query = `INSERT INTo Users(email, password, firstName, lastName, birthdate, gender, height, weight) 
                       values (?, ?, ?, ?, ?, ?, ?, ?)`;
        db.run(query, [user.email, hash, user.firstName, user.lastName, user.birthdate, user.gender, user.height, user.weight], callback);
    };

    /**
     * Updates an existing user in the database.
     * @param {Object} user - The user with updated fields.
     * @param {Function} callback - A callback function to be called after updating.
     */
    this.update = function(user, callback) {
        const hash = bcrypt.hashSync(user.password, 10);
        const query = `UPDATE Users SET password = ?, firstName = ?, lastName = ?, birthdate = ?, gender = ?, height = ?, weight = ? WHERE email = ?`;
        db.run(query, [hash, user.firstName, user.lastName, user.birthdate, user.gender, user.height, user.weight, user.email], callback);
    };

    /**
     * Deletes a user from the database.
     * @param {Object} user - The user to be deleted.
     * @param {Function} callback - A callback function to be called after deletion.
     */
    this.delete = function(user, callback) {
        const query = `DELETE FROM Users WHERE email = ?`;
        db.run(query, [user.email], callback);
    };

    /**
     * Fetches all users from the database.
     * @param {Function} callback - A callback function to handle the fetched users.
     */
    this.findAll = function(callback) {
        const query = "SELECT * FROM Users";
        db.all(query, [], callback);
    };

    /**
     * Fetches a user by their email from the database.
     * @param {string} key - The email of the user.
     * @param {Function} callback - A callback function to handle the fetched user.
     */
    this.findByKey = function(key, callback){
        const query = "SELECT * FROM Users WHERE email = ?";
        db.get(query, [key], callback);
    };

    /**
     * Fetches a user by their email and password from the database. Used for authentication.
     * @param {string} email - The email of the user.
     * @param {string} password - The password of the user.
     * @param {Function} callback - A callback function to handle the fetched user or errors.
     */
    this.findByEmailAndPassword = function(email, password, callback) {
        const query = "SELECT * FROM Users WHERE email = ?";
        db.get(query, [email], function(err, row) {
            if (err) {
                callback(err);
            } else if (!row) {
                callback(null, null);
            } else if (bcrypt.compareSync(password, row.password)) {
                callback(null, row);
            } else {
                callback(null, null);
            }
        });
    };
};

const dao = new UserDAO();
module.exports = dao;
