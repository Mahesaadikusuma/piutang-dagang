<?php

namespace App\Livewire\Admin\Roles;

use App\Models\User;
use App\Repository\RoleRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('layouts.dashboard')]
#[Title('Roles')]
class Index extends Component
{   
    use WithPagination;
    #[Url(history: true)]
    public ?string $search = null;
    public int $limit = 10;

    protected $roleRepository;
    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }

    public function render()
    {   
        $heads = ['No','Name'];
        $roles = $this->roleRepository->getPaginatedRoles($this->search, $this->limit);
        return view('livewire.admin.roles.index', [
            'roles' => $roles,
            'heads' => $heads
        ]);
    }
}
