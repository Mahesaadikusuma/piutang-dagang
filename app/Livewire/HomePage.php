<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Home Page')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.page.home-page');
    }
}
