<?php

namespace model;

class ActivityEntry
{
    private int $dataId;
    private int $activityId;
    private string $dataTime;
    private int $cardioFrequency;
    private float $latitude;
    private float $longitude;
    private float $altitude;

    /**
     * Default constructor for ActivityEntry.
     */
    public function  __construct() { }

    /**
     * Initializes the activity entry with given values.
     * @param int $di Data ID.
     * @param int $ai Activity ID.
     * @param string $dt Data time.
     * @param int $cf Cardio frequency.
     * @param float $la Latitude.
     * @param float $lo Longitude.
     * @param float $al Altitude.
     * @return void
     */
    public function init($di, $ai, $dt, $cf, $la, $lo, $al): void
    {
        $this->dataId = $di;
        $this->activityId = $ai;
        $this->dataTime = $dt;
        $this->cardioFrequency = $cf;
        $this->latitude = $la;
        $this->longitude = $lo;
        $this->altitude = $al;
    }

    /**
     * Returns the data ID.
     * @return int
     */
    public function getDataId(): int { return $this->dataId; }

    /**
     * Returns the activity ID associated with this entry.
     * @return int
     */
    public  function getActivityId(): int { return $this->activityId; }

    /**
     * Returns the time of the data entry.
     * @return string
     */
    public function getDataTime() { return $this->dataTime; }

    /**
     * Returns the cardio frequency for this entry.
     * @return int
     */
    public function getCardioFrequency(): int { return $this->cardioFrequency; }

    /**
     * Returns the latitude value of this entry.
     * @return float
     */
    public function getLatitude(): float { return $this->latitude; }

    /**
     * Returns the longitude value of this entry.
     * @return float
     */
    public function getLongitude(): float { return $this->longitude; }

    /**
     * Returns the altitude value of this entry.
     * @return float
     */
    public function getAltitude(): float { return $this->altitude; }

    /**
     * Returns a string representation of this object.
     * @return string
     */
    public function __toString(): string {
        return $this->dataId . " " . $this->activityId . " " . $this->dataTime . " " . $this->cardioFrequency . " " . $this->latitude . " " . $this->longitude . " " . $this->altitude;
    }
}