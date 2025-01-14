<?php

namespace App\Livewire\Page;

use App\Models\Product;
use App\Service\Front;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Detail Product')]
class DetailPage extends Component
{   
    public Product $product;

    protected $frontService;
    public function mount(Front $frontService)
    {   
        $this->frontService = $frontService;
    }

    #[Computed()]
    public function products()
    {
        return $this->frontService->getOtherProducts($this->product->slug);
    }

    public function render()
    {
        return view('livewire.page.detail-page');
    }
}
