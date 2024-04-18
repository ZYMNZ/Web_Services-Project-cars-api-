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
            $sql .= " AND engine_type LIKE CONCAT(:engine_type,'%')";
            $filters_values['engine_type'] = $filters['engine_type'];
        }
        if (isset($filters['year'])) {
            $sql .= " AND year = :year";
            $filters_values['year'] = $filters['year'];
        }
        if (isset($filters['is_fuel_economic'])) {
            if($filters['is_fuel_economic'] == 'true'){
                $sql .= " AND is_fuel_economic = true";
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

    public function getCarById($car_id) : array
    {
        $sql = "SELECT * FROM cars WHERE car_id = :car_id";
        return ['car' => $this->fetchSingle($sql, ['car_id' => $car_id])];
    }

    public function getCarEmissions($car_id,$filters) : array
    {
        $result = [];
        $filters_values = [];

        $result = $this->getCarById($car_id);

        $sql = "SELECT * FROM emissions e, cars c WHERE c.emission_id = e.emission_id AND car_id = :car_id";
        if(isset($filters['vehicle_class'])){
            $sql .= " AND vehicle_class LIKE CONCAT(:vehicle_class,'%')";
            $filters_values['vehicle_class'] = $filters['vehicle_class'];
        }
        if(isset($filters['fuel_type'])){
            $sql .= " AND fuel_type LIKE CONCAT(:fuel_type,'%')";
            $filters_values['fuel_type'] = $filters['fuel_type'];
        }

        $sql .= " ORDER BY e.emission_id " . $this->sortingOrder($filters);
        $merged_filters = array_merge($filters_values, ['car_id' => $car_id]);
        $result['emissions'] = $this->paginate($sql, $merged_filters);
        return $result;
    }

    public function getCarDeals($car_id,$filters) : array
    {
        $result = [];
        $filters_values = [];

        $result = $this->getCarById($car_id);

        $sql = "SELECT * FROM deals d, cars c WHERE c.deal_id = d.deal_id AND car_id = :car_id";

        if(isset($filters['min_selling_price'])){
            $sql .= " AND selling_price > :min_selling_price";
            $filters_values['min_selling_price'] = $filters['min_selling_price'];
        }
        if(isset($filters['max_selling_price'])){
            $sql .= " AND selling_price < :max_selling_price";
            $filters_values['max_selling_price'] = $filters['max_selling_price'];
        }

        $sql .= " ORDER BY d.deal_id " . $this->sortingOrder($filters);
        $merged_filters = array_merge($filters_values, ['car_id' => $car_id]);
        $result['deals'] = $this->paginate($sql, $merged_filters);
        return $result;
    }

    public function getCarConsumptions($car_id,$filters) : array
    {
        $result = [];
        $filters_values = [];

        $result = $this->getCarById($car_id);

        $sql = "SELECT * FROM consumptions co, cars c WHERE 
        c.consumption_id = co.consumption_id AND car_id = :car_id";

        if(isset($filters['min_consumption_city'])){
            $sql .= " AND fuel_consumption_city > :min_consumption_city";
            $filters_values['min_consumption_city'] = $filters['min_consumption_city'];
        }
        if(isset($filters['max_consumption_city'])){
            $sql .= " AND fuel_consumption_city < :max_consumption_city";
            $filters_values['max_consumption_city'] = $filters['max_consumption_city'];
        }
        if(isset($filters['min_consumption_hwy'])){
            $sql .= " AND fuel_consumption_hwy > :min_consumption_hwy";
            $filters_values['min_consumption_hwy'] = $filters['min_consumption_hwy'];
        }
        if(isset($filters['max_consumption_hwy'])){
            $sql .= " AND fuel_consumption_hwy < :max_consumption_hwy";
            $filters_values['max_consumption_hwy'] = $filters['max_consumption_hwy'];
        }

        $sql .= " ORDER BY co.consumption_id " . $this->sortingOrder($filters);
        $merged_filters = array_merge($filters_values, ['car_id' => $car_id]);
        $result['consumptions'] = $this->paginate($sql, $merged_filters);
        return $result;
    }

    public function createCar(array $cars) : mixed {
        return $this->insert("cars", $cars);
    }
    
    public function updateCars(array $car_data, $car_id) : mixed {
        return $this->update(
            "cars",
            $car_data,
            ["car_id" => $car_id]
        );
    }

    public function deleteCar($car_id) : mixed {
        return $this->delete(
            "cars",
            $car_id
        );
    }
}