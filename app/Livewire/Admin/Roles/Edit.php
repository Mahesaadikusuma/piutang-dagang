<?php

namespace App\Livewire\Admin\Roles;

use App\Repository\RoleRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.dashboard')]
#[Title('Roles')]
class Edit extends Component
{   
    public Role $role;
    public $showModal = false;

    #[Validate('required', message: 'Please enter a name.')]
    #[Validate('min:3', message: 'Your name is too short.')]
    #[Validate('max:59', message: 'Your name is too long.')]
    #[Validate('unique:roles,name', message: 'Your name is already taken.')]
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

    public function updated()
    {
        $this->validate();
        $data = [
            'name' => $this->name
        ];
        $this->roleRepository->updatedrole($data, $this->role);

        // $this->role->update([
        //     'name' => $this->name,
        // ]);

        $this->redirect(Index::class); 
    }
    public function render()
    {
        return view('livewire.admin.roles.edit');
    }
}
