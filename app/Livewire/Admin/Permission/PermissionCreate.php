<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

#[Layout('layouts.dashboard')]
#[Title('Permissions')]
class PermissionCreate extends Component
{
     public $showModal = false;

    // #[Validate(['required','min:3','max:50','unique:roles,name'])]1
    #[Validate('required', message: 'Silahkan masukkan input permission .')]
    #[Validate('min:3', message: 'Minimal characters 3 huruf.')]
    #[Validate('max:60', message: 'role name terlalu panjang maximal 60 huruf.')]
    #[Validate('unique:permissions,name', message: 'Permission name sudah ada.')]
    public $name;


    public function openModal(){
        $this->showModal = true;
    }   

    public function store()
    {
        $this->validate();
        Permission::create([
            'name' => $this->name,
        ]);
        $this->reset('name');
        $this->redirect('/admin/authentication/permissions', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.permission.permission-create');
    }
}
