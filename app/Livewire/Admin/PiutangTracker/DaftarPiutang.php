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
    public $limit = 30;

    protected $piutangRepository;
    public function __construct()
    {
        $this->piutangRepository = new PiutangRepository();
    }   

    #[Computed()]
    public function piutangs()
    {
        return $this->piutangRepository->getPaginatedPiutang($this->search, $this->limit);
    }

    public function render()
    {   $heads = ['No', 'Kode Transaction', 'UserName', 'Transaction Total' ,'Status', 'awal tempo', 'akhir jatuh tempo', 'action'];
        return view('livewire.admin.piutang-tracker.daftar-piutang', [
            'heads' => $heads
        ]);
    }
}
