<?php

namespace Vanier\Api\Models;

class OwnerModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getAllOwners(array $filters, $request, array $filters_values = []): array
    {
        $sql = "SELECT * FROM owners WHERE 1";

        if (isset($filters['name'])) {
            $sql .= " AND name LIKE CONCAT(:name,'%')";
            $filters_values['name'] = $filters['name'];
        }
        if (isset($filters['email'])) {
            $sql .= " AND email LIKE CONCAT(:email,'%')";
            $filters_values['email'] = $filters['email'];
        }
        if (isset($filters['postal_code'])) {
            $sql .= " AND postal_code LIKE CONCAT(:postal_code,'%')";
            $filters_values['postal_code'] = $filters['postal_code'];
        }
        if (isset($filters['country'])) {
            $sql .= " AND country LIKE CONCAT(:country,'%')";
            $filters_values['country'] = $filters['country'];
        }
        if (isset($filters['city'])) {
            $sql .= " AND city LIKE CONCAT(:city,'%')";
            $filters_values['city'] = $filters['city'];
        }
        if (isset($filters['age'])) {
            $sql .= " AND driver_age LIKE CONCAT(:age,'%')";
            $filters_values['age'] = $filters['age'];
        }
        if (isset($filters['gender'])) {
            $sql .= " AND driver_gender LIKE CONCAT(:gender,'%')";
            $filters_values['gender'] = $filters['gender'];
        }

        $sql .= " ORDER BY owner_id";
        return ['players' => $this->paginate($sql, $filters_values)];
    }

    public function getOwnerInfo(string $owner_id): array
    {
        $sql = "SELECT * FROM owners WHERE owner_id = :owner_id";
        return ['owner' => $this->fetchSingle($sql, ['owner_id' => $owner_id])];
    }

    public function getOwnerCars(mixed $owner_id, array $filters, array $filters_values = []): array
    {
        $sql = "SELECT * FROM
            owners o, cars c
        WHERE o.owner_id = c.owner_id
          AND o.owner_id = :owner_id";
        
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

        $result = $this->getOwnerInfo($owner_id);
        $sql .= " ORDER BY o.owner_id" . $this->sortingOrder($filters);
        $result['cars'] = $this->paginate($sql, ['owner_id' => $owner_id, ...$filters_values]);
        return $result;
    }

    public function getOwnerDeals(string $owner_id, array $filters, array $filters_values = []): array
    {
        $sql = "SELECT * FROM
            owners o, cars c, deals d
        WHERE o.owner_id = c.owner_id
          AND c.deal_id = d.deal_id
          AND o.owner_id = :owner_id";

        if (isset($filters['selling_price'])) {
            $sql.= " AND d.selling_price >= :selling_price";
            $filters_values["selling_price"] = $filters['selling_price'];
        }
        if (isset($filters['km_driven'])) {
            $sql.= " AND d.km_driven >= :km_driven";
            $filters_values["km_driven"] = $filters['km_driven'];
        }

        $result = $this->getOwnerInfo($owner_id);
        $sql .= " ORDER BY o.owner_id" . $this->sortingOrder($filters);
        $result['deals'] = $this->paginate($sql, ['owner_id' => $owner_id, ...$filters_values]);
        return $result;
    }

    public function getOwnerViolations(string $owner_id, array $filters, array $filters_values = []): array
    {
        $sql = "SELECT * FROM
             owners o, cars c, violations_cars vc, violations v
        WHERE o.owner_id = c.owner_id
          AND c.car_id = vc.car_id
          AND vc.violation_id = v.violation_id
          AND o.owner_id = :owner_id";

        if (isset($filters['location'])) {
            $sql.= " AND v.location LIKE CONCAT(:location,'%')";
            $filters_values["location"] = $filters['location'];
        }
        if (isset($filters['violation_type'])) {
            $sql.= " AND v.violation_type = :violation_type";
            $filters_values["violation_type"] = $filters['violation_type'];
        }
        if (isset($filters['is_arrested'])) {
            $sql .= " AND v.is_arrested = ";
            $sql .= $filters['is_arrested'] === 'true' ? 1 : 0;
        }
        if (isset($filters['violation_start_date'])) {
            $sql.= " AND v.violation_date >= :violation_start_date";
            $filters_values["violation_start_date"] = $filters['violation_start_date'];
        }
        if (isset($filters['violation_end_date'])) {
            $sql.= " AND v.violation_date <= :violation_end_date";
            $filters_values["violation_end_date"] = $filters['violation_end_date'];
        }
        if (isset($filters['violation_fee'])) {
            $sql.= " AND v.violation_fee >= :violation_fee";
            $filters_values["violation_fee"] = $filters['violation_fee'];
        }

        $result = $this->getOwnerInfo($owner_id);
        $sql .= " ORDER BY o.owner_id" . $this->sortingOrder($filters);
        $result['violations'] = $this->paginate($sql, ['owner_id' => $owner_id, ...$filters_values]);
        return $result;
    }

    public function createOwner(array $data): false|string
    {
        return $this->insert("owners", $data);
    }

    public function updateOwners(array $owner_data, $owner_id)
    {
        return $this->update(
            "owners",
            $owner_data,
            ["owner_id" => $owner_id]
        );
    }

    public function deleteOwner($owner_id) : mixed {
        return $this->delete(
            "owners",
            $owner_id
        );
    }
}