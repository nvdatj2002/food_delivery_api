<?php
class CaculateService
{
    function calculateDistanceBetweenCoordinates($latitude1, $longitude1, $latitude2, $longitude2)
    {
        // Earth's radius in kilometers
        $earthRadius = 6371.01;

        // Convert latitude and longitude to radians
        $latitude1InRadians = deg2rad($latitude1);
        $longitude1InRadians = deg2rad($longitude1);
        $latitude2InRadians = deg2rad($latitude2);
        $longitude2InRadians = deg2rad($longitude2);

        // Calculate the distance
        $distance = 2 * $earthRadius * asin(sqrt(pow(sin($latitude1InRadians - $latitude2InRadians) / 2, 2)
            + cos($latitude1InRadians) * cos($latitude2InRadians)
            * pow(sin($longitude1InRadians - $longitude2InRadians) / 2, 2)));

        // Return the distance in kilometers
        return $distance;
    }
}
