<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Layout('layouts.dashboard')]
#[Title('User Edit')]
class UserEdit extends Component
{
    public User $user;
    public bool $showModal = false;
    public string $name;
    public string $email;
    public array $rolesSelected = [];
    public array $permissionsSelected = []; 
    
    protected $rules = [
        'name' => 'required|string|min:3|max:100',
        'email' => 'sometimes|required|email',
        'rolesSelected' => 'array',
        'rolesSelected.*' => 'exists:roles,id',
        'permissionsSelected' => 'array', // Validasi array permission
        'permissionsSelected.*' => 'exists:permissions,id',
    ];

    protected $messages = [
        'name.required' => 'Nama User harus diisi',
        'name.string' => 'Nama User harus berupa string',
        'name.min' => 'Nama User harus minimal 3 karakter',
        'name.max' => 'Nama User maksimal 100 karakter',
        'email.required' => 'Alamat email harus diisi',
        'email.string' => 'Email harus berupa string',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'rolesSelected.array' => 'Roles harus berupa array',
        'rolesSelected.*.exists' => 'Role yang dipilih tidak valid',
        'permissionsSelected.array' => 'Permissions harus berupa array',
        'permissionsSelected.*.exists' => 'Permission yang dipilih tidak valid',
    ];

    protected  $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function openModal()
    {
        $this->showModal = true;
    }   

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $this->user->name;
        $this->email = $this->user->email;

        $this->rolesSelected = $this->user->roles->pluck('id')->toArray();
        $this->permissionsSelected = $this->user->permissions->pluck('id')->toArray();
    }

    #[Computed(cache: true)]
    public function roles()
    {
        return $this->userRepository->getAllRoles();
    }

    #[Computed(cache: true)]
    public function permissions()
    {
        return $this->userRepository->getAllPermissions();
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        
        $roles = Role::whereIn('id', $this->rolesSelected)->get();
        $rolesArray = $roles->pluck('id')->toArray();

        $this->userRepository->syncUserRoles($this->user, $rolesArray);
        // $this->user->syncRoles($roles);

        $permissions = Permission::whereIn('id', $this->permissionsSelected)->get();
        // $this->user->syncPermissions($permissions);
        $permissionsArray = $permissions->pluck('id')->toArray();
        $this->userRepository->syncUserPermissions($this->user, $permissionsArray);
        
        session()->flash('success', 'User role updated successfully.');
        $this->redirect('/admin/authentication/users', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.user-edit');
    }
}
