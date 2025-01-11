<?php

namespace App\Livewire\Admin\Permission;

use App\Repository\PermissionRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

#[Layout('layouts.dashboard')]
#[Title('Permission')]
class PermissionList extends Component
{
    use WithPagination;
    
    #[Url(history: true)]
    public ?string $search = null;
    public int $limit = 10;

    protected $permissionRepository;
    public function __construct()
    {
        $this->permissionRepository = new PermissionRepository();
    }

    public function render()
    {
        $heads = ['No','Name'];
        $permissions = $this->permissionRepository->getPaginatedPermissions($this->search, $this->limit);
        return view('livewire.admin.permission.permission-list', [
            'heads' => $heads,
            'permissions' => $permissions
        ]);
    }
}
