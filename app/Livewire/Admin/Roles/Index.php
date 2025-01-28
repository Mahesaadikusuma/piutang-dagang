<?php

namespace App\Livewire\Admin\Roles;

use App\Models\User;
use App\Repository\RoleRepository;
use Livewire\Attributes\Computed;
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
    #[Url]
    public $search = '';

    #[Url()]
    public $limit = 5;

    #[Url(history:true)]
    public $sortBy = 'id';

    #[Url(history:true)]
    public $sortDir = 'ASC';

    protected $roleRepository;
    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
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
    public function roles()
    {
       return $this->roleRepository->getPaginatedRoles($this->search, $this->limit, $this->sortBy, $this->sortDir);
    }

    public function render()
    {   
        $heads = ['No','Name'];
        return view('livewire.admin.roles.index', [        
            'heads' => $heads
        ]);
    }
}
