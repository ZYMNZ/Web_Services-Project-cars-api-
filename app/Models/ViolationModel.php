<?php

namespace Vanier\Api\Models;

class ViolationModel extends BaseModel
{

    public function getAllViolations(array $filters): array
    {
        $sql = "SELECT * FROM violations WHERE 1";

        $filters_values = [];
        if (isset($filters[''])) {
            $filters_values['csc'] = $filters['csc'];
        }

        $sql .= " ORDER BY violation_id";
        return ['violations' => $this->paginate($sql, $filters_values)];
    }
}