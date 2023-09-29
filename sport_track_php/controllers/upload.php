<?php

use model\Activity;
use model\ActivityDAO;
use model\ActivityEntry;
use model\ActivityEntryDAO;
use model\CalculDistanceImpl;

require_once(__ROOT__ . '/controllers/Controller.php');
require_once(__ROOT__ . '/model/ActivityEntryDAO.php');
require_once(__ROOT__ . '/model/ActivityDAO.php');
require_once(__ROOT__ . '/model/CalculDistanceImpl.php');
require_once(__ROOT__ . '/model/ActivityEntry.php');
require_once(__ROOT__ . '/model/Activity.php');

class UploadActivityController extends Controller
{
    /**
     * Renders the form for uploading activities.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request): void
    {
        $this->render('upload_activity_form', []);
    }

    /**
     * Processes the uploaded activity file, parses its content, and saves activity data to the database.
     * If successful, the user is redirected to the panel; otherwise, an error message is displayed.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function post($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['email']) || !$_SESSION['email'] || !isset($_SESSION['password']) || !$_SESSION['password']) {
            $this->render('main', ['error' => 'Pas de session ouverte.']);
            return;
        }

        $activityEntryDAO = ActivityEntryDAO::getInstance();
        $activityDAO = ActivityDAO::getInstance();

        if (!isset($_FILES['file']) || $_FILES['file']['error'] != 0) {
            $this->render('upload_activity_form', ['error' => 'No file uploaded or there was an upload error.']);
            return;
        }

        try {
            $data = json_decode(file_get_contents($_FILES['file']['tmp_name']), true);

            if (!isset($data['activity']) || !isset($data['data'])) {
                $this->render('upload_activity_form', ['error' => 'Invalid file format.']);
                return;
            }

            $activityId = $activityDAO->getLastId();
            $userEmail = $_SESSION['email'];
            $description = $data['activity']['description'];
            $parcours = $data['data'];
            $distance = (new CalculDistanceImpl())->calculDistanceTrajet($parcours);

            $entryCount = count($data['data']);
            $startTime = $data['data'][0]['time'];
            $endTime = $data['data'][$entryCount - 1]['time'];
            $cardioFrequencyMin = $cardioFrequencyMax = $data['data'][0]['cardio_frequency'];
            $cardioFrequencySum = 0;

            foreach ($data['data'] as $entry) {
                $activityEntry = new ActivityEntry();
                $activityEntry->init(0, $activityId, $entry['time'], $entry['cardio_frequency'], $entry['latitude'], $entry['longitude'], $entry['altitude']);
                $activityEntryDAO->insert($activityEntry);

                $cardioFrequencyMin = min($cardioFrequencyMin, $entry['cardio_frequency']);
                $cardioFrequencyMax = max($cardioFrequencyMax, $entry['cardio_frequency']);
                $cardioFrequencySum += $entry['cardio_frequency'];
            }

            $duration = (new DateTime($startTime))->diff(new DateTime($endTime))->s;
            $cardioFrequencyAverage = $cardioFrequencySum / $entryCount;

            $activity = new Activity();
            $activity->init(0, $userEmail, $data['activity']['date'], $startTime, $endTime, $duration, $description, $distance, $cardioFrequencyMin, $cardioFrequencyMax, $cardioFrequencyAverage);
            $activityDAO->insert($activity);

        } catch (TypeError $e) {
            $this->render('upload_activity_form', ['error' => 'Erreur lors de l\'upload du fichier.']);
            return;
        }

        $this->render('panel', []);
    }
}
