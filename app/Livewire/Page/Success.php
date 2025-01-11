<?php

namespace App\Livewire\Page;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('layouts.app')]
#[Title('Success')]
class Success extends Component
{
    public function render()
    {
        return view('livewire.page.success');
    }
}
