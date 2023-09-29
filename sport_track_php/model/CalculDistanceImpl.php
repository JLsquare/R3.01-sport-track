<?php
namespace model;

require_once 'CalculDistance.php';

class CalculDistanceImpl implements CalculDistance
{
    /**
     * Calculate the distance between two GPS coordinates using the Haversine formula.
     * @param float $lat1 Latitude of the first point in degrees.
     * @param float $long1 Longitude of the first point in degrees.
     * @param float $lat2 Latitude of the second point in degrees.
     * @param float $long2 Longitude of the second point in degrees.
     * @return float Distance between the two points in meters.
     */
    public function calculDistance2PointsGPS(float $lat1, float $long1, float $lat2, float $long2): float
    {
        $R = 6378137;

        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $long1 = deg2rad($long1);
        $long2 = deg2rad($long2);

        $d = $R * acos(sin($lat2) * sin($lat1) + cos($lat2) * cos($lat1) * cos($long2 - $long1));

        return $d;
    }

    /**
     * Calculate the total distance of a journey based on an array of GPS coordinates.
     * @param array $parcours List of arrays with 'latitude' and 'longitude' keys representing the journey.
     * @return float Total distance of the journey in meters.
     */
    public function calculDistanceTrajet(array $parcours): float
    {
        $totalDistance = 0;

        for ($i = 0; $i < count($parcours) - 1; $i++) {
            $point1 = $parcours[$i];
            $point2 = $parcours[$i + 1];

            $distance = $this->calculDistance2PointsGPS(
                $point1['latitude'],
                $point1['longitude'],
                $point2['latitude'],
                $point2['longitude']
            );

            $totalDistance += $distance;
        }

        return $totalDistance;
    }
}

