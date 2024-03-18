<?php

namespace Vanier\Api\Models;

class OwnerModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getAllOwners(array $filters): array
    {
        $sql = "SELECT * FROM owners WHERE 1";

        $filters_values = [];
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

    public function getOwnerCars(mixed $owner_id, array $filters): array
    {
        $sql = "SELECT * FROM
            owners o, cars c
        WHERE o.owner_id = c.owner_id
          AND o.owner_id = :owner_id";

        $filter_values = [];
        if (isset($filters['tournament_id'])) {
            $sql.= " AND g.tournament_id = :tournament_id";
            $filter_values["tournament_id"] = $filters['tournament_id'];
        }
        if (isset($filters['match_id'])) {
            $sql.= " AND g.match_id = :match_id";
            $filter_values["match_id"] = $filters['match_id'];
        }

        $result = $this->getOwnerInfo($owner_id);
        $sql .= " ORDER BY o.owner_id" . $this->sortingOrder($filters);
        $result['cars'] = $this->paginate($sql, ['owner_id' => $owner_id, ...$filter_values]);
        return $result;
    }

    public function getOwnerViolations(string $owner_id, array $filters): array
    {
        $sql = "SELECT * FROM
             owners o, cars c, violations_cars vc, violations v
        WHERE o.owner_id = c.owner_id
          AND c.car_id = vc.car_id
          AND vc.violation_id = v.violation_id
          AND o.owner_id = :owner_id";

        $filter_values = [];
        if (isset($filters['tournament_id'])) {
            $sql.= " AND g.tournament_id = :tournament_id";
            $filter_values["tournament_id"] = $filters['tournament_id'];
        }
        if (isset($filters['match_id'])) {
            $sql.= " AND g.match_id = :match_id";
            $filter_values["match_id"] = $filters['match_id'];
        }

        $result = $this->getOwnerInfo($owner_id);
        $sql .= " ORDER BY o.owner_id" . $this->sortingOrder($filters);
        $result['violations'] = $this->paginate($sql, ['owner_id' => $owner_id, ...$filter_values]);
        return $result;
    }

    public function getOwnerDeals(string $owner_id, array $filters): array
    {
        $sql = "SELECT * FROM
            owners o, cars c, deals d
        WHERE o.owner_id = c.owner_id
          AND c.deal_id = d.deal_id
          AND o.owner_id = :owner_id";

        $filter_values = [];
        if (isset($filters['tournament_id'])) {
            $sql.= " AND g.tournament_id = :tournament_id";
            $filter_values["tournament_id"] = $filters['tournament_id'];
        }
        if (isset($filters['match_id'])) {
            $sql.= " AND g.match_id = :match_id";
            $filter_values["match_id"] = $filters['match_id'];
        }

        $result = $this->getOwnerInfo($owner_id);
        $sql .= " ORDER BY o.owner_id" . $this->sortingOrder($filters);
        $result['deals'] = $this->paginate($sql, ['owner_id' => $owner_id, ...$filter_values]);
        return $result;
    }
}