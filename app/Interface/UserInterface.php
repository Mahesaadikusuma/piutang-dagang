<?php

namespace App\Interface;

use App\Models\User;

interface UserInterface
{
    public function getAll();
    public function userHasRole();
    public function getPaginatedUsers(?string $search, int $limit);
    public function getAllRoles();
    public function getAllPermissions();
    public function syncUserRoles($user, array $roles);
    public function syncUserPermissions($user, array $permission): void;
}
