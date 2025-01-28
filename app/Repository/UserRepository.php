<?php

namespace App\Repository;

use App\Interface\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Strings;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserInterface
{
    protected $userModel;
    protected $roleModel;
    protected $permissionModel;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
        $this->permissionModel = new Permission();
    }

    public function getAll()
    {
        return $this->userModel->all();
    }

    public function getPaginatedUsers(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC')
    {
        return $this->userModel
            ->with(['roles', 'permissions'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortDir)
            ->paginate($limit);

    }

    public function getAllRoles()
    {        
        return $this->roleModel->all();
    }

    public function getAllPermissions()
    {
        return $this->permissionModel->all();
    }

    public function syncUserRoles($user, array $roles)
    {
        $user->syncRoles($roles);
    }
    public function syncUserPermissions($user, array $permission): void
    {
        $user->syncPermissions($permission);
    }

    public function userHasRole()
    {
        // $this->userModel = Auth::User();
        // $hasAllRoles = $this->userModel->hasAllRoles($this->roleModel->all());

        // return $hasAllRoles;
    }
}
