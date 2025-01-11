<?php

namespace App\Interface;

use App\Models\User;

interface PermissionInterface
{
    public function getAll();
    public function getPaginatedPermissions(?string $search, int $limit);
    public function createdPermission(array $data);
    public function updatedPermission(array $data, $Permission);
    public function deletedPermission($PermissionId);
}
