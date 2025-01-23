<?php

namespace App\Livewire\Admin\PiutangTracker\Cicilan;

use App\Models\Cicilan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.dashboard')]
#[Title('Piutang Tracker Cicilan')]
class EditCidilan extends Component
{   
    public Cicilan $cicilan;
    public $showModal = false;

    public $product;
    public $jumlahCicilan;
    public $awalTempo;
    public $akhirJatuhTempo;
    public $statusPembayaran;
    public $tanggalLunas;
    public function mount(Cicilan $cicilan)
    {
        $this->product = $cicilan->piutang->product->name;
        $this->jumlahCicilan = $cicilan->jumlah_cicilan;
        $this->awalTempo = $cicilan->awal_tempo;
        $this->akhirJatuhTempo = $cicilan->akhir_jatuh_tempo;
        $this->statusPembayaran = $cicilan->status_pembayaran;
        $this->tanggalLunas = $cicilan->tanggal_lunas;
    }

    public function openModal(){
        $this->showModal = true;
    }   

    public function updated()
    {

    }

    public function render()
    {
        return view('livewire.admin.piutang-tracker.cicilan.edit-cidilan');
    }
}
