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
class Create extends Component
{
    public $showModal = false;

    #[Validate('required', message: 'Inputkan role name.')]
    #[Validate('min:3', message: 'Minimal characters 3 huruf.')]
    #[Validate('max:60', message: 'role name terlalu panjang maximal 60 huruf.')]
    #[Validate('unique:roles,name', message: 'roles name sudah ada.')]
    public $name;

    protected $roleRepository;
    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }

    public function openModal(){
        $this->showModal = true;
    }   

    public function store()
    {
        $this->validate();
        $data = [
            'name' => $this->name
        ];
        $this->roleRepository->createdrole($data);
        $this->reset('name');
        $this->redirect('/admin/authentication/roles', navigate: true);
    }


    public function render()
    {
        return view('livewire.admin.roles.create');
    }
}
