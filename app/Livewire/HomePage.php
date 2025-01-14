<?php

namespace App\Livewire;

use App\Service\Front;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Home Page')]
class HomePage extends Component
{

    protected $frontService;

    // Menggunakan mount untuk menyuntikkan Front service
    public function mount(Front $frontService)
    {
        $this->frontService = $frontService;
    }
    public function render()
    {   
        $data = $this->frontService->getFrontData();
        return view('livewire.page.home-page',$data);
    }
}
