<?php

namespace Vanier\Api\Models;

class InsuranceModel extends BaseModel
{
    public function getAllInsurances(array $filters): array
    {
        $sql = "SELECT * FROM insurances WHERE 1";

        $filters_values = [];
        if (isset($filters['name'])) {
            $sql .= " AND insurance_name LIKE CONCAT(:name,'%')";
            $filters_values['name'] = $filters['name'];
        }
        if (isset($filters['experience'])) {
            $sql .= " AND driving_experience LIKE CONCAT(:name,'%')";
            $filters_values['experience'] = $filters['experience'];
        }
        if (isset($filters['vehicle_year'])) {
            $sql .= " AND vehicle_year LIKE CONCAT(:name,'%')";
            $filters_values['vehicle_year'] = $filters['vehicle_year'];
        }
        if (isset($filters['vehicle_type'])) {
            $sql .= " AND vehicle_type LIKE CONCAT(:vehicle_type,'%')";
            $filters_values['vehicle_type'] = $filters['vehicle_type'];
        }
        if (isset($filters['annual_mileage'])) {
            $sql .= " AND annual_mileage LIKE CONCAT(:annual_mileage,'%')";
            $filters_values['annual_mileage'] = $filters['annual_mileage'];
        }
        if (isset($filters['price'])) {
            $sql .= " AND price = :price";
            $filters_values['price'] = $filters['price'];
        }

        $sql .= " ORDER BY insurance_id " . $this->sortingOrder($filters);
        return ['insurances' => $this->paginate($sql, $filters_values)];
    }

    public function getInsuranceInfo($insurance_id): array
    {
        $sql = "SELECT * FROM insurances WHERE insurance_id = :insurance_id";
        return ['insurance' => $this->fetchSingle($sql, ['insurance_id' => $insurance_id])];
    }

    public function getInsuranceOwners(string $insurance_id, array $filters): array
    {
        $sql = "SELECT * FROM
             insurances i, owners o
        WHERE i.insurance_id = o.insurance_id
          AND i.insurance_id = :insurance_id";

        $filter_values = [];
        if (isset($filters['tournament_id'])) {
            $sql.= " AND g.tournament_id = :tournament_id";
            $filter_values["tournament_id"] = $filters['tournament_id'];
        }
        if (isset($filters['match_id'])) {
            $sql.= " AND g.match_id = :match_id";
            $filter_values["match_id"] = $filters['match_id'];
        }

        $result = $this->getInsuranceInfo($insurance_id);
        $sql .= " ORDER BY i.insurance_id" . $this->sortingOrder($filters);
        $result['owners'] = $this->paginate($sql, ['insurance_id' => $insurance_id, ...$filter_values]);
        return $result;
    }
}