<?php

namespace App\Livewire\Admin\Roles;

use App\Repository\RoleRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.dashboard')]
#[Title('Roles')]
class Delete extends Component
{   
    public Role $role;
    public $showModal = false;

    public $name;

    protected $roleRepository;
    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }

    public function mount(Role $role)
    {
        $this->name = $role->name;
    }

    public function openModal(){
        $this->showModal = true;
    }  

    public function delete()
    {
        $this->roleRepository->deletedrole($this->role);
        $this->showModal = false;


        $this->redirect(Index::class); 
    }

    public function render()
    {
        return view('livewire.admin.roles.delete');
    }
}
