<?php

namespace App\Livewire\Admin\PiutangTracker;

use App\Models\Piutang;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.dashboard')]
#[Title('Piutang Tracker Detail')]
class PiutangDetail extends Component
{   
    public Piutang $piutang;

    public function render()
    {   
        $heads = ['Nomer Cicilan','Product', 'jumlah cicilan', 'awal tempo', 'akhir jatuh tempo', 'status pembanyaran'];
        return view('livewire.admin.piutang-tracker.piutang-detail', [
            'heads' => $heads
        ]);
    }
}
