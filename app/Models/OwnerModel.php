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
        if (isset($filters['csc'])) {

        }

        $sql .= " ORDER BY owner_id";
        return ['players' => $this->paginate($sql, $filters_values)];
    }

    public function getOwnerInfo(string $owner_id): array
    {
        $sql = "SELECT * FROM owners WHERE owner_id = :owner_id";
        return ['owner' => $this->fetchSingle($sql, ['owner_id' => $owner_id])];
    }
}