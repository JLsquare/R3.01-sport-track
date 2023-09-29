<?php include __ROOT__."/views/head.html"; ?>

<?php include __ROOT__."/views/header.html"; ?>

<main class="d-flex flex-column justify-content-center align-items-center h-100">
    <div class="d-flex h-50 justify-content-center align-items-center m-3">
        <section class="p-4 bg-white rounded-4 h-100 shadow mx-auto overflow-auto">
            <form action="/activities" method="post">
                <h2>Liste des activités</h2>
                <hr>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Heure Début</th>
                        <th>Heure Fin</th>
                        <th>Durée (seconde)</th>
                        <th>Distance (mètre)</th>
                        <th>Fréq. Cardiaque Min.</th>
                        <th>Fréq. Cardiaque Max.</th>
                        <th>Fréq. Cardiaque Moy.</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($data['activities'] as $index => $activity) {
                        echo '<tr style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapse'.$index.'" aria-expanded="true">';
                        echo '<td>'.$activity->getDescription().'</td>';
                        echo '<td>'.$activity->getActivityDate().'</td>';
                        echo '<td>'.$activity->getStartTime().'</td>';
                        echo '<td>'.$activity->getEndTime().'</td>';
                        echo '<td>'.$activity->getDuration().'</td>';
                        echo '<td>'.$activity->getDistance().'</td>';
                        echo '<td>'.$activity->getCardioFrequencyMin().'</td>';
                        echo '<td>'.$activity->getCardioFrequencyMax().'</td>';
                        echo '<td>'.$activity->getCardioFrequencyAverage().'</td>';
                        echo '<td><button type="submit" name="delete_activity" value="' . $activity->getActivityId() . '" class="btn btn-danger">Supprimer</button></td>';
                        echo '</tr>';
                        echo '<tr class="nested-table collapse" id="collapse'.$index.'">';
                        echo '<td colspan="10" class="p-0">';
                        echo '<table class="table table-bordered table-striped m-0">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Temps</th>';
                        echo '<th>Freq Cardiaque</th>';
                        echo '<th>Altitude</th>';
                        echo '<th>Longitude</th>';
                        echo '<th>Altitude</th>';
                        echo '<th></th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        foreach($data['activitiesEntries'][$index] as $entryIndex => $activityEntry) {
                            echo '<tr>';
                            echo '<td>'.$activityEntry->getDataTime().'</td>';
                            echo '<td>'.$activityEntry->getCardioFrequency().'</td>';
                            echo '<td>'.$activityEntry->getLatitude().'</td>';
                            echo '<td>'.$activityEntry->getLongitude().'</td>';
                            echo '<td>'.$activityEntry->getAltitude().'</td>';
                            echo '<td class="text-end"><button type="submit" name="delete_activity_entry" value="' . $activityEntry->getDataId() . '" class="btn btn-danger">Supprimer</button></td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </section>
    </div>
    <div class="text-center d-flex justify-content-around w-50">
        <div class="w-100 m-3"></div>
        <a href="/panel" class="btn btn-primary w-100 m-2 shadow">Retour</a>
        <div class="w-100 m-3"></div>
    </div>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
