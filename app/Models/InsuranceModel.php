<?php

namespace Vanier\Api\Models;

class InsuranceModel extends BaseModel
{
    public function getAllInsurances(array $filters): array
    {
        $sql = "SELECT * FROM insurances WHERE 1";

        $filters_values = [];
        if (isset($filters['csc'])) {

        }

        $sql .= " ORDER BY insurance_id " . $this->sortingOrder($filters);
        return ['insurances' => $this->paginate($sql, $filters_values)];
    }
}