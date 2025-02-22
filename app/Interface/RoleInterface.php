<?php

namespace App\Interface;

use App\Models\User;

interface RoleInterface
{
    public function getAll();
    public function getPaginatedRoles(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC');
    public function createdrole(array $data);
    public function updatedrole(array $data, $role);
    public function deletedrole($roleId);
}
