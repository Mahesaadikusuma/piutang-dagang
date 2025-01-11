<?php

namespace App\Livewire\Admin\Permission;

use App\Repository\PermissionRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

#[Layout('layouts.dashboard')]
#[Title('Permission Edit')]
class PermissionEdit extends Component
{
    public Permission $permission;

    #[Validate('required', message: 'Please enter a name.')]
    #[Validate('min:3', message: 'Your name is too short.')]
    #[Validate('max:59', message: 'Your name is too long.')]
    #[Validate('unique:permissions,name', message: 'Your name is already taken.')]
    public $name;


    public $showModal = false;
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

    public function updated()
    {
        $this->validate();
        $data = [
            'name' => $this->name
        ];
        $this->permissionRepository->updatedPermission($data, $this->permission);

        $this->redirect(PermissionList::class); 
    }

    public function render()
    {
        return view('livewire.admin.permission.permission-edit');
    }
}
