<?php

namespace Vanier\Api\Models;

class ConsumptionModel extends BaseModel 
{
    public function getAllConsumptions(array
    $filters): array
    {
        $sql = "SELECT * FROM consumptions WHERE 1";

        $filters_values = [];
        // Engine Size
        if (isset($filters['engine_size'])) {
            $sql .= " AND engine_size = :engine_size";
            $filters_values['engine_size'] = $filters['engine_size']; 
        }   

        if (isset($filters['fuel_consumption_city'])) {
            $sql .= " AND fuel_consumption_city = :fuel_consumption_city";
            $filters_values['fuel_consumption_city'] = $filters['fuel_consumption_city'];
        }

        if (isset($filters['fuel_consumption_hwy'])) {
            $sql .= " AND fuel_consumption_hwy = :fuel_consumption_hwy";
            $filters_values['fuel_consumption_hwy'] = $filters['fuel_consumption_hwy'];
        }

        if (isset($filters['fuel_consumption_combined'])) {
            $sql .= " AND fuel_consumption_combined = :fuel_consumption_combined";
            $filters_values['fuel_consumption_combined'] = $filters['fuel_consumption_combined'];
        }

        $sql .= " ORDER BY consumption_id " .
        // var_dump($sql);
        $this->sortingOrder($filters);
        return ['consumptions' => $this->paginate($sql, $filters_values)];
    }

    public function getConsumptionInfo($consumption_id): array
    {
        $sql = "SELECT * FROM consumptions WHERE consumption_id = :consumption_id";
        return ['consumption' => $this->fetchSingle($sql, ['consumption_id' => $consumption_id])];
    }

    public function createConsumption(array $consumptions) : mixed {
        return $this->insert("consumptions", $consumptions); 
    }

    public function updateConsumptions(array $consumption_data, $consumption_id) : mixed {
        return $this->update(
            "consumptions",
            $consumption_data,
            ["consumption_id" => $consumption_id]
        );
    }

    public function deleteConsumption($consumption_id) : mixed {
        return $this->delete(
            "consumptions",
            ["consumption_id" => $consumption_id]
        );
    }
}