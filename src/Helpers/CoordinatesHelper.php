<?php

namespace Tots\Core\Helpers;

/**
 * Description of CsvHelper
 *
 * @author matiascamiletti
 */
class CoordinatesHelper 
{
    public static function splitName($latitude, $longitude, $mts)
    {
        // Radio aproximado de la Tierra en metros
        $radioTierra = 6371000;

        // Convertir las coordenadas de grados a radianes
        $latitudRadianes = deg2rad($latitude);
        $longitudRadianes = deg2rad($longitude);

        // Calcular el desplazamiento en radianes
        $desplazamientoRadial = $mts / $radioTierra;

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
}