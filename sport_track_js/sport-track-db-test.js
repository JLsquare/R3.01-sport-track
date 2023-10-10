const user_dao = require('sport-track-db').user_dao;
const activity_dao = require('sport-track-db').activity_dao;
const activity_entry_dao = require('sport-track-db').activity_entry_dao;

const userObj = {
    email: 'john.doe@example.com',
    password: 'somepassword',
    firstName: 'John',
    lastName: 'Doe',
    birthdate: '2004-07-12',
    gender: 'male',
    height: 180.0,
    weight: 70.0
};

const activityObj = {
    activityId: 1,
    userEmail: 'john.doe@example.com',
    activityDate: '2023-09-13',
    startTime: '12:00:00',
    endTime: '13:00:00',
    duration: 60.0,
    description: 'Running',
    distance: 5.0,
    cardioFrequencyMin: 80,
    cardioFrequencyMax: 120,
    cardioFrequencyAverage: 100
};

const activityEntryObj = {
    id: 1,
    activityId: 1,
    dateTime: '2023-09-13 12:01:00',
    heartRate: 80,
    latitude: 37.7749,
    longitude: -122.4194,
    elevation: 5.0
};

function insertUser() {
    user_dao.insert(userObj, (err) => {
        if (err) console.error(err);
        user_dao.findAll((err, allUsers) => {
            console.log("User inserted");
            allUsers.forEach(user => console.log(user));
            updateUser();
        });
    });
}

function updateUser() {
    userObj.height = 200.0;

    user_dao.update(userObj, (err) => {
        if (err) console.error(err);
        user_dao.findAll((err, allUsers) => {
            console.log("User updated");
            allUsers.forEach(user => console.log(user));
            deleteUser();
        });
    });
}

function deleteUser() {
    user_dao.delete(userObj, (err) => {
        if (err) console.error(err);
        user_dao.findAll((err, allUsers) => {
            console.log("User deleted");
            allUsers.forEach(user => console.log(user));
        });
    });
}

function insertActivity() {
    activity_dao.insert(activityObj, (err) => {
        if (err) console.error(err);
        activity_dao.findAll((err, allActivities) => {
            console.log("Activity inserted");
            allActivities.forEach(activity => console.log(activity));
            updateActivity();
        });
    });
}

function updateActivity() {
    activityObj.endTime = '13:30:00';
    activity_dao.update(activityObj, (err) => {
        if (err) console.error(err);
        activity_dao.findAll((err, allActivities) => {
            console.log("Activity updated");
            allActivities.forEach(activity => console.log(activity));
            deleteActivity();
        });
    });
}

function deleteActivity() {
    activity_dao.delete(activityObj, (err) => {
        if (err) console.error(err);
        activity_dao.findAll((err, allActivities) => {
            console.log("Activity deleted");
            allActivities.forEach(activity => console.log(activity));
        });
    });
}

function insertActivityEntry() {
    activity_entry_dao.insert(activityEntryObj, (err) => {
        if (err) console.error(err);
        activity_entry_dao.findAll((err, allEntries) => {
            console.log("ActivityEntry inserted");
            allEntries.forEach(entry => console.log(entry));
            updateActivityEntry();
        });
    });
}

function updateActivityEntry() {
    activityEntryObj.dateTime = '2023-09-13 12:02:00';
    activity_entry_dao.update(activityEntryObj, (err) => {
        if (err) console.error(err);
        activity_entry_dao.findAll((err, allEntries) => {
            console.log("ActivityEntry updated");
            allEntries.forEach(entry => console.log(entry));
            deleteActivityEntry();
        });
    });
}

function deleteActivityEntry() {
    activity_entry_dao.delete(activityEntryObj, (err) => {
        if (err) console.error(err);
        activity_entry_dao.findAll((err, allEntries) => {
            console.log("ActivityEntry deleted");
            allEntries.forEach(entry => console.log(entry));
        });
    });
}

insertUser();
insertActivity();
insertActivityEntry();
