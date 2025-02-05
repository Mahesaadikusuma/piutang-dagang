<?php

namespace App\Repository;

use App\Interface\RoleInterface;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Strings;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;
use Masmerise\Toaster\Toaster;

class RoleRepository implements RoleInterface
{
    
    protected $roleModel;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->roleModel = new Role();
    }

    public function getAll()
    {
        return $this->roleModel->all();
    }

    public function getPaginatedRoles(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC')
    {
        $roles = $this->roleModel
            ->with(['permissions'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortDir)
            ->paginate($limit);


        if ($search) {
            if ($roles->isNotEmpty()) {
                Toaster::success("Data yang dicari ditemukan.");
            } else {
                Toaster::error("Data yang dicari tidak ditemukan.");
            }
        }

        return $roles;
    }

    public function createdrole(array $data)
    {
        $this->roleModel->create($data);
    }
    public function updatedrole(array $data, $role)
    {
        $role->update($data);
        return $role;
    }
    public function deletedrole($roleId)
    {
        return $roleId->delete();
    }
}
