<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use App\Repository\ProductRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Product List')]
class ProductList extends Component
{   
    use WithPagination;

    #[Url()]
    public $search = '';

    public $limit = 20;

    protected $productRepository;
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    #[On('product-deleted')] 
    public function render()
    {
        $heads = ['No','Name','Category','Description', 'Thumbnail', 'Stock', 'Price', 'created_at'];
        $products = $this->productRepository->getPaginatedProducts($this->search, $this->limit);

        return view('livewire.admin.product.product-list', [
            'heads' => $heads,
            'products' => $products
        ]);
    }
}
