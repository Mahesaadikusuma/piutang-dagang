<?php

namespace App\Livewire\Admin\PiutangTracker;

use App\Repository\PiutangRepository;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Piutang Tracker')]
class DaftarPiutang extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';
    
    #[Url()]
    public $limit = 5;

    #[Url(history:true)]
    public $sortBy = 'id';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    protected $piutangRepository;
    public function __construct()
    {
        $this->piutangRepository = new PiutangRepository();
    }   

    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    #[Computed()]
    public function piutangs()
    {
        return $this->piutangRepository->getPaginatedPiutang($this->search, $this->limit, $this->sortBy,$this->sortDir);
    }

    public function render()
    {   $heads = ['No', 'Kode Transaction', 'UserName', 'Transaction Total' ,'Status', 'awal tempo', 'akhir jatuh tempo', 'action'];
        return view('livewire.admin.piutang-tracker.daftar-piutang', [
            'heads' => $heads
        ]);
    }
}
