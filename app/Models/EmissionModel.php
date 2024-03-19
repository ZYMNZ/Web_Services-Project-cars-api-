<?php

namespace Vanier\Api\Models;

class EmissionModel extends BaseModel 
{
    public function getAllEmissions(array
    $filters): array
    {
        $sql = "SELECT * FROM emissions WHERE 1";

        $filters_values = []; 
        if (isset($filters['csc'])) {

        }

        $sql .= " ORDER BY emission_id " .
        $this->sortingOrder($filters);
        return ['emissions' => $this->paginate($sql, $filters_values)];
    }
}