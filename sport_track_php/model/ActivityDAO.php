<?php

namespace model;

use PDO;

require_once('SqliteConnection.php');
require_once('Activity.php');

class ActivityDAO
{
    private static ActivityDAO $dao;

    /**
     * Private constructor for singleton pattern.
     */
    private function __construct() { }

    /**
     * Returns the singleton instance of the ActivityDAO.
     * @return ActivityDAO The instance of the ActivityDAO.
     */
    public static function getInstance(): ActivityDAO
    {
        if (!isset(self::$dao)) {
            self::$dao = new ActivityDAO();
        }
        return self::$dao;
    }

    /**
     * Finds and returns all activities from the database.
     * @return array Array of Activity objects.
     */
    public final function findAll(): array
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Activities";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\model\Activity');
        return $results;
    }

    /**
     * Finds and returns all activities related to a specific user.
     * @param User $user The user to retrieve activities for.
     * @return array Array of Activity objects.
     */
    public final function findAllFromUser(User $user): array
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Activities WHERE userEmail = :ue";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':ue', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\model\Activity');
        return $results;
    }

    /**
     * Inserts an activity into the database.
     * @param Activity $activity The activity to insert.
     * @return void
     */
    public final function insert(Activity $activity): void
    {
        if ($activity instanceof Activity) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "INSERT INTO Activities(userEmail, activityDate, startTime, endTime, duration, description, distance, cardioFrequencyMin, cardioFrequencyMax, cardioFrequencyAverage) 
                      VALUES (:ue, :ad, :st, :et, :du, :de, :di, :cfMin, :cfMax, :cfAvg)";
            $stmt = $dbc->prepare($query);

            $stmt->bindValue(':ue', $activity->getUserEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':ad', $activity->getActivityDate(), PDO::PARAM_STR);
            $stmt->bindValue(':st', $activity->getStartTime(), PDO::PARAM_STR);
            $stmt->bindValue(':et', $activity->getEndTime(), PDO::PARAM_STR);
            $stmt->bindValue(':du', $activity->getDuration(), PDO::PARAM_STR);
            $stmt->bindValue(':de', $activity->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':di', $activity->getDistance(), PDO::PARAM_STR);
            $stmt->bindValue(':cfMin', $activity->getCardioFrequencyMin(), PDO::PARAM_INT);
            $stmt->bindValue(':cfMax', $activity->getCardioFrequencyMax(), PDO::PARAM_INT);
            $stmt->bindValue(':cfAvg', $activity->getCardioFrequencyAverage(), PDO::PARAM_STR);

            $stmt->execute();
        }
    }

    /**
     * Deletes an activity from the database.
     * @param Activity $activity The activity to delete.
     * @return void
     */
    public function delete(Activity $activity): void
    {
        if ($activity instanceof Activity) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "DELETE FROM Activities WHERE activityId = :ai";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':ai', $activity->getActivityId(), PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    /**
     * Updates an activity in the database.
     * @param Activity $activity The activity with updated data.
     * @return void
     */
    public function update(Activity $activity): void
    {
        if ($activity instanceof Activity) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "UPDATE Activities SET 
                      userEmail = :ue, 
                      activityDate = :ad,
                      startTime = :st,
                      endTime = :et,
                      duration = :du,
                      description = :de, 
                      distance = :di,
                      cardioFrequencyMin = :cfMin,
                      cardioFrequencyMax = :cfMax,
                      cardioFrequencyAverage = :cfAvg
                      WHERE activityId = :ai";

            $stmt = $dbc->prepare($query);

            $stmt->bindValue(':ue', $activity->getUserEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':ad', $activity->getActivityDate(), PDO::PARAM_STR);
            $stmt->bindValue(':st', $activity->getStartTime(), PDO::PARAM_STR);
            $stmt->bindValue(':et', $activity->getEndTime(), PDO::PARAM_STR);
            $stmt->bindValue(':du', $activity->getDuration(), PDO::PARAM_STR);
            $stmt->bindValue(':de', $activity->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':di', $activity->getDistance(), PDO::PARAM_STR);
            $stmt->bindValue(':cfMin', $activity->getCardioFrequencyMin(), PDO::PARAM_INT);
            $stmt->bindValue(':cfMax', $activity->getCardioFrequencyMax(), PDO::PARAM_INT);
            $stmt->bindValue(':cfAvg', $activity->getCardioFrequencyAverage(), PDO::PARAM_STR);
            $stmt->bindValue(':ai', $activity->getActivityId(), PDO::PARAM_INT);

            $stmt->execute();
        }
    }

    /**
     * Gets the last activity ID from the database.
     * @return int The last activity ID.
     */
    public function getLastId(): int {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT seq FROM sqlite_sequence WHERE name='Activities'";
        $stmt = $dbc->query($query);
        $result = $stmt->fetch();
        if ($result) {
            return $result['seq'] + 1;
        } else {
            return 1;
        }
    }


    /**
     * Finds and returns an activity from the database.
     * @param int $delete_activity The activity ID to find.
     * @return Activity The activity found.
     */
    public function find(int $delete_activity): ?Activity
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Activities WHERE activityId = :ai";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':ai', $delete_activity, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchObject('\model\Activity');
        return $results;
    }
}
