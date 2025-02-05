<?php

namespace App\Repository;

use App\Interface\PermissionInterface;
use Masmerise\Toaster\Toaster;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    
    protected $permissionModel;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->permissionModel = new Permission();
    }

    public function getAll()
    {
        return $this->permissionModel->all();
    }

    public function getPaginatedPermissions(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC')
    {
        $permission = $this->permissionModel
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortDir)
            ->paginate($limit);
        
        if ($search) {
            if ($permission->isNotEmpty()) {
                Toaster::success("Data yang dicari ditemukan.");
            } else {
                Toaster::error("Data yang dicari tidak ditemukan.");
            }
        }

        return $permission;
    }

    public function createdPermission(array $data)
    {
        $this->permissionModel->create($data);
    }
    public function updatedPermission(array $data, $Permission)
    {
        $Permission->update($data);
        return $Permission;
    }
    public function deletedPermission($PermissionId)
    {
        return $PermissionId->delete();
    }
}
