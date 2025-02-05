<?php

namespace App\Livewire\Admin\PiutangTracker\Cicilan;

use App\Models\Cicilan;
use Livewire\Component;

class Transaction extends Component
{
    public Cicilan $cicilan;

    public function render()
    {
        return view('livewire.admin.piutang-tracker.cicilan.transaction');
    }
}
