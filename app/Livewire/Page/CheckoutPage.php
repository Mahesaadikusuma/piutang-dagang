<?php

namespace App\Livewire\Page;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Layout('layouts.app')]
#[Title('Checkout Product')]
class CheckoutPage extends Component
{
    public Product $product;

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.page.checkout-page');
    }
}
