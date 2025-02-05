<?php

namespace App\Livewire\Admin\PiutangTracker;

use App\Models\Piutang;
use App\Repository\PiutangRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.dashboard')]
#[Title('Piutang Tracker Detail')]
class PiutangDetail extends Component
{   
    public Piutang $piutang;

    #[Url(history:true)]
    public $sortBy = 'id';

    #[Url(history:true)]
    public $sortDir = 'ASC';

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
        $this->sortDir = 'ASC';
    }

    #[On("cicilan-updated")]
    public function render()
    {   
        $heads = ['Nomer Cicilan','Product', 'jumlah cicilan', 'awal tempo', 'akhir jatuh tempo', 'status pembanyaran', "action"];

        $cicilans = $this->piutangRepository->getCicilanByPiutang($this->piutang, $this->sortBy, $this->sortDir);
        return view('livewire.admin.piutang-tracker.piutang-detail', [
            'heads' => $heads,
            'cicilans' => $cicilans,
        ]);
    }
}
