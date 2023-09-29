<?php

namespace model;

use PDO;

require_once('SqliteConnection.php');
require_once('User.php');

class ActivityEntryDAO
{
    private static ActivityEntryDAO $dao;

    /**
     * Private constructor for singleton pattern.
     */
    private function __construct() { }

    /**
     * Returns an instance of ActivityEntryDAO.
     * @return ActivityEntryDAO
     */
    public static function getInstance(): ActivityEntryDAO
    {
        if (!isset(self::$dao)) {
            self::$dao = new ActivityEntryDAO();
        }
        return self::$dao;
    }

    /**
     * Fetches all activity entries from the database.
     * @return array An array of ActivityEntry objects.
     */
    public final function findAll(): array
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, '\model\ActivityEntry');
        return $results;
    }

    /**
     * Fetches all activity entries for a given activity from the database.
     * @param Activity $activity The activity for which entries should be fetched.
     * @return array An array of ActivityEntry objects related to the given activity.
     */
    public final function findAllFromActivity(Activity $activity)
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data where activityId = :ai";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':ai', $activity->getActivityId());
        $stmt->execute();
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, '\model\ActivityEntry');
        return $results;
    }

    /**
     * Inserts a new activity entry into the database.
     * @param ActivityEntry $entry The activity entry to be inserted.
     * @return void
     */
    public final function insert(ActivityEntry $entry): void
    {
        if ($entry instanceof ActivityEntry) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "insert into Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude) values (:ai, :dt, :cf, :la, :lo, :al)";
            $stmt = $dbc->prepare($query);

            $stmt->bindValue(':ai', $entry->getActivityId(), PDO::PARAM_STR);
            $stmt->bindValue(':dt', $entry->getDataTime(), PDO::PARAM_STR);
            $stmt->bindValue(':cf', $entry->getCardioFrequency(), PDO::PARAM_STR);
            $stmt->bindValue(':la', $entry->getLatitude(), PDO::PARAM_STR);
            $stmt->bindValue(':lo', $entry->getLongitude(), PDO::PARAM_STR);
            $stmt->bindValue(':al', $entry->getAltitude(), PDO::PARAM_STR);

            $stmt->execute();
        }
    }

    /**
     * Deletes an activity entry from the database.
     * @param ActivityEntry $entry The activity entry to be deleted.
     * @return void
     */
    public function delete(ActivityEntry $entry): void
    {
        if($entry instanceof ActivityEntry) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "delete from Data where dataId = :di";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':di', $entry->getDataId(), PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    /**
     * Updates an existing activity entry in the database.
     * @param ActivityEntry $entry The activity entry with updated values.
     * @return void
     */
    public function update(ActivityEntry $entry): void
    {
        if($entry instanceof ActivityEntry) {
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "update Data set activityId = :ai, dataTime = :dt, cardioFrequency = :cf, latitude = :la, longitude = :lo, altitude = :al where dataId = :di";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':ai', $entry->getActivityId(), PDO::PARAM_STR);
            $stmt->bindValue(':dt', $entry->getDataTime(), PDO::PARAM_STR);
            $stmt->bindValue(':cf', $entry->getCardioFrequency(), PDO::PARAM_STR);
            $stmt->bindValue(':la', $entry->getLatitude(), PDO::PARAM_STR);
            $stmt->bindValue(':lo', $entry->getLongitude(), PDO::PARAM_STR);
            $stmt->bindValue(':al', $entry->getAltitude(), PDO::PARAM_STR);
            $stmt->bindValue(':di', $entry->getDataId(), PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    /**
     * Fetches an activity entry from the database.
     * @param int $dataId The ID of the activity entry to be fetched.
     * @return ActivityEntry|null The activity entry if found; null otherwise.
     */
    public function find(int $dataId): ?ActivityEntry
    {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data where dataId = :di";
        $stmt = $dbc->prepare($query);
        $stmt->bindValue(':di', $dataId);
        $stmt->execute();
        $result = $stmt->fetchObject('\model\ActivityEntry');
        return $result;
    }
}