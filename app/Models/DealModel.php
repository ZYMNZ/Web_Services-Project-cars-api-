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
        /**
         * min_ selling_price
         * max_selling_price
         * min_km_driven
         * max_km_driven
         * fuel_type
         * transmission_type
         * car_condition
         */
        if (isset($filters['min_selling_price'])) {
            $sql .= " AND selling_price > :min_selling_price";
            $filters_values['min_selling_price'] = $filters['min_selling_price'];
        }
        if (isset($filters['max_selling_price'])) {
            $sql .= " AND selling_price < :max_selling_price";
            $filters_values['max_selling_price'] = $filters['max_selling_price'];
        }
        if (isset($filters['min_km_driven'])) {
            $sql .= " AND km_driven > :min_km_driven";
            $filters_values['min_km_driven'] = $filters['min_km_driven'];
        }
        if (isset($filters['max_km_driven'])) {
            $sql .= " AND km_driven < :max_km_driven";
            $filters_values['max_km_driven'] = $filters['max_km_driven'];
        }
        if (isset($filters['fuel_type'])) {
            $sql .= " AND fuel_type LIKE CONCAT(:fuel_type, '%')";
            $filters_values['fuel_type'] = $filters['fuel_type'];
        }
        if (isset($filters['transmission_type'])) {
            $sql .= " AND transmission LIKE CONCAT(:transmission_type, '%')";
            $filters_values['transmission_type'] = $filters['transmission_type'];
        }

        $sql .= " ORDER BY deal_id " . $this->sortingOrder($filters);
        return ['deals' => $this->paginate($sql, $filters_values)];
    }

    public function getDealById($deal_id) : array
    {
        $sql = "SELECT * FROM deals WHERE deal_id = :deal_id";
        return (array)$this->fetchSingle($sql, ['deal_id' => $deal_id]);
    }

    public function getDealInsurances($deal_id) : array
    {
        $result = [];
        $filters_values = [];

        $this->getDealById($deal_id);

        $sql = "SELECT * FROM deals d, cars c,owners o, insurances i 
         WHERE d.deal_id = c.deal_id 
           AND c.owner_id = o.owner_id 
           AND o.insurance_id = i.insurance_id 
           AND d.deal_id = :deal_id";
        if(isset($filters['min_price'])){
            $sql .= " AND price > :min_price";
            $filters_values['min_price'] = $filters['min_price'];
        }
        if(isset($filters['max_price'])){
            $sql .= " AND price < :max_price";
            $filters_values['max_price'] = $filters['max_price'];
        }
        $sql .= " ORDER BY i.insurance_id " . $this->sortingOrder($filters);
        $merged_filters = array_merge($filters_values, ['deal_id' => $deal_id]);
        $result['insurances'] = $this->paginate($sql, $merged_filters);
        return $result;

    }
}