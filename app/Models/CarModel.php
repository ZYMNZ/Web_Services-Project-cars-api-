<?php

namespace Vanier\Api\Models;

class CarModel extends BaseModel
{

    public function getAllCars(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM cars WHERE 1";

        if (isset($filters['amount_of_cylinders'])) {
            $sql .= " AND cylinders > :amount_of_cylinders";
            $filters_values['amount_of_cylinders'] = $filters['amount_of_cylinders'];
        }
        if (isset($filters['engine_type'])) {
            $sql .= " AND engine_type CONCAT(:engine_type,'%')";
            $filters_values['engine_type'] = $filters['engine_type'];
        }
        if (isset($filters['year'])) {
            $sql .= " AND year = :year";
            $filters_values['year'] = $filters['year'];
        }
        if (isset($filters['is_fuel_economic'])) {
            if($filters['is_fuel_economic'] == 'true'){
                $sql .= " AND is_fuel_economic = 1";
            }else if($filters['is_fuel_economic'] == 'false'){
                $sql .= " AND is_fuel_economic = 0";
            }
        }
        if (isset($filters['car_make'])) {
            $sql .= " AND car_make LIKE CONCAT(:car_make,'%')";
            $filters_values['car_make'] = $filters['car_make'];
        }
        if (isset($filters['car_model'])) {
            $sql .= " AND car_model LIKE CONCAT(:car_model,'%')";
            $filters_values['car_model'] = $filters['car_model'];
        }


        $sql .= " ORDER BY car_id " . $this->sortingOrder($filters);
        return ['cars' => $this->paginate($sql, $filters_values)];
    }

    public function getCarById($car_id)
    {
        $sql = "SELECT * FROM cars WHERE car_id = :car_id";
        return $this->fetchSingle($sql, ['car_id' => $car_id]);
    }
}