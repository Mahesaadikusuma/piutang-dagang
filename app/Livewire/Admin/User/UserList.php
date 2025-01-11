<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('layouts.dashboard')]
#[Title('Users')]
class UserList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';
    public $limit = 10;
    
    protected $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function render()
    {
        $heads = ['No', 'Name', 'Email', 'Role', 'Permission', 'Created At'];
        $users = $this->userRepository->getPaginatedUsers($this->search, $this->limit);

        return view('livewire.admin.user.user-list', [
            'heads' => $heads,
            'users' => $users,
        ]);
    }
}
