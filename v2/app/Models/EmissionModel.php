<?php

namespace Vanier\Api\Models;

class EmissionModel extends BaseModel 
{
    public function getAllEmissions(array
    $filters): array
    {
        $sql = "SELECT * FROM emissions WHERE 1";

        $filters_values = [];
        // Engine Size
        if (isset($filters['engine_size'])) {
            $sql .= " AND engine_size = :engine_size";
            $filters_values['engine_size'] = $filters['engine_size']; 
        }    

        // Cylinder_num
        if (isset($filters['cylinder_num'])) {
            $sql .= " AND cylinder_num LIKE CONCAT(:cylinder_num,'%')";
            $filters_values['cylinder_num'] = $filters['cylinder_num'];
        }

        // Fuel Type
        if (isset($filters['fuel'])) {
            $sql .= " AND fuel_type LIKE CONCAT(:fuel,'%')";
            $filters_values['fuel'] = $filters['fuel'];
        }

        // Vehicle Class
        if (isset($filters['class'])) {
            $sql .= " AND vehicle_class LIKE CONCAT(:class,'%')";
            $filters_values['class'] = $filters['class'];
        }

        // CO2 Emission
        if (isset($filters['co2_emission'])) {
            $sql .= " AND co2_emission LIKE CONCAT(:co2_emission,'%')";
            $filters_values['co2_emission'] = $filters['co2_emission'];
        }

        

        $sql .= " ORDER BY emission_id " .
        $this->sortingOrder($filters);
        // var_dump($sql);
        return ['emissions' => $this->paginate($sql, $filters_values)];
    }

    public function getEmissionInfo($emission_id): array
    {
        $sql = "SELECT * FROM emissions WHERE emission_id = :emission_id";
        return ['emission' => $this->fetchSingle($sql, ['emission_id' => $emission_id])];
    }
}