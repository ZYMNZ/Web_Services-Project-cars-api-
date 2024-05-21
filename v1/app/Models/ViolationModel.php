<?php

namespace Vanier\Api\Models;

class ViolationModel extends BaseModel
{

    public function getAllViolations(array $filters, array $filters_values = []): array
    {
        $sql = "SELECT * FROM violations WHERE 1";

        if (isset($filters['location'])) {
            $sql .= " AND location LIKE CONCAT(:location,'%')";
            $filters_values['location'] = $filters['location'];
        }
        if (isset($filters['violation_type'])) {
            $sql .= " AND violation_type LIKE CONCAT(:violation_type,'%')";
            $filters_values['violation_type'] = $filters['violation_type'];
        }
        if (isset($filters['arrested_status'])) {
            $sql .= " AND arrested_status LIKE CONCAT(:arrested_status,'%')";
            $filters_values['arrested_status'] = $filters['arrested_status'];
        }
        if (isset($filters['date'])) {
            $sql .= " AND violation_date LIKE CONCAT(:date,'%')";
            $filters_values['date'] = $filters['date'];
        }
        if (isset($filters['fee'])) {
            $sql .= " AND violation_fee LIKE CONCAT(:fee,'%')";
            $filters_values['fee'] = $filters['fee'];
        }

        $sql .= " ORDER BY violation_id";
        return ['violations' => $this->paginate($sql, $filters_values)];
    }

    public function getViolationInfo(string $violation_id): array
    {
        $sql = "SELECT * FROM violations WHERE violation_id = :violation_id";
        return ['violation' => $this->fetchSingle($sql, ['violation_id' => $violation_id])];
    }

    public function getViolationCars(string $violation_id, array $filters, array $filters_values = []): array
    {
        $sql = "SELECT * FROM
            violations v, violations_cars vc, cars c
        WHERE v.violation_id = vc.violation_id
          AND vc.car_id = c.car_id
          AND v.violation_id = :violation_id";

        if (isset($filters['horsepower'])) {
            $sql.= " AND c.horsepower >= :horsepower";
            $filters_values["horsepower"] = $filters['horsepower'];
        }
        if (isset($filters['year'])) {
            $sql.= " AND c.year = :year";
            $filters_values["year"] = $filters['year'];
        }
        if (isset($filters['car_make'])) {
            $sql.= " AND c.car_make LIKE CONCAT(:car_make,'%')";
            $filters_values["car_make"] = $filters['car_make'];
        }
        if (isset($filters['car_model'])) {
            $sql.= " AND c.car_model LIKE CONCAT(:car_model,'%')";
            $filters_values["car_model"] = $filters['car_model'];
        }
        if (isset($filters['is_fuel_economic'])) {
            $sql.= " AND c.is_fuel_economic = :is_fuel_economic";
            $filters_values["is_fuel_economic"] = $filters['is_fuel_economic'];
        }

        $result = $this->getViolationInfo($violation_id);
        $sql .= " ORDER BY v.violation_id" . $this->sortingOrder($filters);
        $result['cars'] = $this->paginate($sql, ['violation_id' => $violation_id, ...$filters_values]);
        return $result;
    }
}