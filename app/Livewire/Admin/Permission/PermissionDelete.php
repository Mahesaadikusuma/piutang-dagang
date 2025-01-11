<?php

namespace App\Livewire\Admin\Permission;

use App\Repository\PermissionRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

#[Layout('layouts.dashboard')]
#[Title('Permission Delete')]
class PermissionDelete extends Component
{
    public Permission $permission;
    public $showModal = false;

    public $name;

    protected $permissionRepository;
    public function __construct()
    {
        $this->permissionRepository = new PermissionRepository();
    }

    public function mount(Permission $permission)
    {
        $this->name = $permission->name;
    }

    public function openModal(){
        $this->showModal = true;
    }  

    public function delete()
    {
        $this->permissionRepository->deletedPermission($this->permission);
        $this->showModal = false;
        $this->redirect(PermissionList::class); 
    }
    public function render()
    {
        return view('livewire.admin.permission.permission-delete');
    }
}
