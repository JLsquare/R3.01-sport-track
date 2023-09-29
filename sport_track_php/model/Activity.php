<?php

namespace model;

class Activity
{
    private int $activityId;
    private string $userEmail;
    private string $activityDate;
    private string $startTime;
    private string $endTime;
    private float $duration;
    private string $description;
    private float $distance;
    private int $cardioFrequencyMin;
    private int $cardioFrequencyMax;
    private float $cardioFrequencyAverage;

    /**
     * Default constructor for Activity.
     */
    public function  __construct() { }

    /**
     * Initializes the activity with given values.
     * @param int $ai Activity ID.
     * @param string $ue User's email.
     * @param string $ad Activity date.
     * @param string $st Start time.
     * @param string $et End time.
     * @param float $du Duration.
     * @param string $de Description.
     * @param float $di Distance.
     * @param int $cfMin Minimum cardio frequency.
     * @param int $cfMax Maximum cardio frequency.
     * @param float $cfAvg Average cardio frequency.
     * @return void
     */
    public function init($ai, $ue, $ad, $st, $et, $du, $de, $di, $cfMin, $cfMax, $cfAvg): void
    {
        $this->activityId = $ai;
        $this->userEmail = $ue;
        $this->activityDate = $ad;
        $this->startTime = $st;
        $this->endTime = $et;
        $this->duration = $du;
        $this->description = $de;
        $this->distance = $di;
        $this->cardioFrequencyMin = $cfMin;
        $this->cardioFrequencyMax = $cfMax;
        $this->cardioFrequencyAverage = $cfAvg;
    }

    /**
     * Returns the activity ID.
     * @return int
     */
    public function getActivityId(): int { return $this->activityId; }

    /**
     * Returns the user's email associated with the activity.
     * @return string
     */
    public function getUserEmail(): string { return $this->userEmail; }

    /**
     * Returns the activity date.
     * @return string
     */
    public function getActivityDate(): string { return $this->activityDate; }

    /**
     * Returns the start time of the activity.
     * @return string
     */
    public function getStartTime(): string { return $this->startTime; }

    /**
     * Returns the end time of the activity.
     * @return string
     */
    public function getEndTime(): string { return $this->endTime; }

    /**
     * Returns the duration of the activity.
     * @return string
     */
    public function getDuration(): string { return $this->duration; }

    /**
     * Returns the description of the activity.
     * @return string
     */
    public function getDescription(): string { return $this->description; }

    /**
     * Returns the distance covered in the activity rounded to 2 decimal places.
     * @return string
     */
    public function getDistance(): string { return round($this->distance, 2); }

    /**
     * Returns the minimum cardio frequency recorded during the activity.
     * @return int
     */
    public function getCardioFrequencyMin(): int { return $this->cardioFrequencyMin; }

    /**
     * Returns the maximum cardio frequency recorded during the activity.
     * @return int
     */
    public function getCardioFrequencyMax(): int { return $this->cardioFrequencyMax; }

    /**
     * Returns the average cardio frequency of the activity rounded to 2 decimal places.
     * @return float
     */
    public function getCardioFrequencyAverage(): float { return round($this->cardioFrequencyAverage, 2); }

    /**
     * Returns a string representation of the activity.
     * @return string
     */
    public function __toString(): string
    {
        return $this->activityId . " " . $this->userEmail . " " . $this->activityDate . " " . $this->startTime . " " . $this->endTime . " " . $this->duration . " " . $this->description . " " . $this->distance . " " . $this->cardioFrequencyMin . " " . $this->cardioFrequencyMax . " " . $this->cardioFrequencyAverage;
    }
}
