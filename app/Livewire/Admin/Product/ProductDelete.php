<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.dashboard')]
#[Title('Product Edit')]
class ProductDelete extends Component
{

    public Product $product;
    public $showModal = false;

    protected $productRepository;
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function mount()
    {
        $this->product->name;
    }

    public function delete_confirm() {
        $this->showModal = true;
    }

    public function delete()
    {
        try {
            $this->productRepository->deleteProduct($this->product);
            Toaster::success('Produk berhasil dihapus!');
            $this->showModal = false;
            // return $this->redirect('/admin/product', navigate:true);
            $this->dispatch("product-deleted"); 
        } catch (\Exception $e) {
            Toaster::error('valida: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.admin.product.product-delete');
    }
}
