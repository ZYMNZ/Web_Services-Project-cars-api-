<?php

namespace Vanier\Api\Models;

class DealModel extends BaseModel
{

    public function getAllDeals(array $filters)
    {
        $filters_values = [];
        $sql = "SELECT * FROM deals WHERE 1";
        if (isset($filters['amount_of_cylinders'])) {
            $sql .= " AND amount_of_cylinders > :amount_of_cylinders";
            $filters_values[] = $filters['amount_of_cylinders'];
        }

        $sql .= " ORDER BY deal_id " . $this->sortingOrder($filters);
        return ['deals' => $this->paginate($sql, $filters_values)];
    }
}