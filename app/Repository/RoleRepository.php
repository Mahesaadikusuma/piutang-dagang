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
        return $this->roleModel
            ->with(['permissions'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortDir)
            ->paginate($limit);
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
