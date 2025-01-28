<?php

namespace App\Livewire\Admin\Permission;

use App\Repository\PermissionRepository;
use Livewire\Attributes\Computed;
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
    
    #[Url]
    public $search = '';

    #[Url()]
    public $limit = 5;

    #[Url(history:true)]
    public $sortBy = 'id';

    #[Url(history:true)]
    public $sortDir = 'ASC';

    protected $permissionRepository;
    public function __construct()
    {
        $this->permissionRepository = new PermissionRepository();
    }

    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'ASC';
    }

    #[Computed(persist: true)]
    public function permissions()
    {
       return $this->permissionRepository->getPaginatedPermissions($this->search, $this->limit, $this->sortBy, $this->sortDir);
    }

    public function render()
    {
        $heads = ['No','Name'];
        
        return view('livewire.admin.permission.permission-list', [
            'heads' => $heads,
        ]);
    }
}
