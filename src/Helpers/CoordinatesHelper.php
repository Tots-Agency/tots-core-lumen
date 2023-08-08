<?php

namespace Tots\Core\Helpers;

/**
 * Description of CsvHelper
 *
 * @author matiascamiletti
 */
class CoordinatesHelper 
{
    public static function sumMts($latitude, $longitude, $mts)
    {
        return self::sumBase($latitude, $longitude, 6371000, $mts);
    }

    public static function sumMiles($latitude, $longitude, $miles)
    {
        return self::sumBase($latitude, $longitude, 3959, $miles);
    }

    public static function sumBase($latitude, $longitude, $earthRadius, $value)
    {
        // Convertir las coordenadas de grados a radianes
        $latitudRadianes = deg2rad($latitude);
        $longitudRadianes = deg2rad($longitude);

        // Calcular el desplazamiento en radianes
        $desplazamientoRadial = $value / $earthRadius;

        // Calcular la nueva latitud
        $nuevaLatitudRadianes = $latitudRadianes + $desplazamientoRadial;

        // Convertir la nueva latitud a grados
        $nuevaLatitud = rad2deg($nuevaLatitudRadianes);

        // Calcular la nueva longitud
        $nuevaLongitudRadianes = $longitudRadianes + $desplazamientoRadial / cos($latitudRadianes);

        // Convertir la nueva longitud a grados
        $nuevaLongitud = rad2deg($nuevaLongitudRadianes);

        // Devolver las nuevas coordenadas
        return ['latitude' => $nuevaLatitud, 'longitude' => $nuevaLongitud];
    }

    public static function calculateDistanceInMiles($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 3959; // Radio de la Tierra en millas

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}