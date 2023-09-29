<?php

use model\ActivityEntry;
use model\ActivityEntryDAO;
use model\User;
use model\UserDAO;
use model\Activity;
use model\ActivityDAO;

require_once('model/User.php');
require_once('model/UserDAO.php');
require_once('model/Activity.php');
require_once('model/ActivityDAO.php');
require_once('model/ActivityEntry.php');
require_once('model/ActivityEntryDAO.php');
require_once('model/SqliteConnection.php');

define ("__ROOT__",__DIR__);
const DB_FILE = __ROOT__.'/db/sport_track.db';

//User
print("User\n");
$userDAO = UserDAO::getInstance();

//Insert User
$newUser = new User();
$newUser->init('john.doe@example.com', 'somepassword', 'John', 'Doe','2004-07-12', 'male', 180.0, 70.0);

$userDAO->insert($newUser);

$allUsers = $userDAO->findAll();
foreach ($allUsers as $user) {
    print($user."\n");
}

//Update User
$updateUser = new User();
$updateUser->init('john.doe@example.com', 'somepassword', 'John', 'Doe', '2004-07-12', 'male', 200.0, 70.0);

$userDAO->update($updateUser);

$allUsers = $userDAO->findAll();
foreach ($allUsers as $user) {
    print($user."\n");
}

//Delete User
$deleteUser = new User();
$deleteUser->init('john.doe@example.com', '', '', '', '', '', 0, 0);

$userDAO->delete($deleteUser);

$allUsers = $userDAO->findAll();
foreach ($allUsers as $user) {
    print($user."\n");
}

//Activity
print("Activity\n");
$activityDAO = ActivityDAO::getInstance();

//Insert Activity
$newActivity = new Activity();
$newActivity->init(1, 'john.doe@example.com', '2023-09-13', '12:00:00', '13:00:00', 60.0, 'Running', 5.0, 80, 120, 100);

$activityDAO->insert($newActivity);

$allActivities = $activityDAO->findAll();
foreach ($allActivities as $activity) {
    print($activity."\n");
}

//Update Activity
$updateActivity = new Activity();
$updateActivity->init(1, 'john.doe@example.com', '2023-09-13', '12:00:00', '13:30:00', 90.0, 'Updated Running', 6.0, 85, 130, 110);

$activityDAO->update($updateActivity);

$allActivities = $activityDAO->findAll();
foreach ($allActivities as $activity) {
    print($activity."\n");
}

//Delete Activity
$deleteActivity = new Activity();
$deleteActivity->init(1, 'john.doe@example.com', '2023-09-13', '12:00:00', '13:00:00', 60.0, 'Running', 5.0, 80, 120, 100);

$activityDAO->delete($deleteActivity);

$allActivities = $activityDAO->findAll();
foreach ($allActivities as $activity) {
    print($activity."\n");
}

//Delete User
$deleteUser = new User();
$deleteUser->init('john.doe@example.com', '', '', '', '', '', 0, 0);

$userDAO->delete($deleteUser);

$allUsers = $userDAO->findAll();
foreach ($allUsers as $user) {
    print($user."\n");
}

// ActivityEntry
print("ActivityEntry\n");
$activityEntryDAO = ActivityEntryDAO::getInstance();

// Insert ActivityEntry
$newEntry = new ActivityEntry();
$newEntry->init(1, 1, '2023-09-13 12:01:00', 80, 37.7749, -122.4194, 5.0);
$activityEntryDAO->insert($newEntry);

$allEntries = $activityEntryDAO->findAll();
foreach ($allEntries as $entry) {
    print($entry."\n");
}

// Update ActivityEntry
$updateEntry = new ActivityEntry();
$updateEntry->init(1, 1, '2023-09-13 12:02:00', 85, 37.7749, -122.4194, 6.0);
$activityEntryDAO->update($updateEntry);

$allEntries = $activityEntryDAO->findAll();
foreach ($allEntries as $entry) {
    print($entry."\n");
}

// Delete ActivityEntry
$deleteEntry = new ActivityEntry();
$deleteEntry->init(1, 1, '2023-09-13 12:01:00', 80, 37.7749, -122.4194, 5.0);
$activityEntryDAO->delete($deleteEntry);

$allEntries = $activityEntryDAO->findAll();
foreach ($allEntries as $entry) {
    print($entry."\n");
}