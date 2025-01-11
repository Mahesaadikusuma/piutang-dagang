<?php

namespace App\Livewire\Admin\Product;

use App\Repositories\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use App\Repository\ProductRepository;
use Exception;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.dashboard')]
#[Title('Product Edit')]
class ProductEdit extends Component
{
    use WithFileUploads;

    public Product $product;

    protected $productRepository;
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    #[Validate("required|exists:categories,id")]
    public $category_id;
    
    #[Validate('required|string|min:5|max:255', message: 'Name Product harus di isi', translate: true)]
    public $name;

    #[Validate("required|string|min:5")]
    public $description;

    #[Validate("nullable|image|mimes:jpeg,png,jpg|max:3048")]
    public $thumbnail;
    
    #[Validate("required|integer")]
    public $price;

    #[Validate("required|integer")]
    public $stock;

    

    #[Computed()]
    public function categories()
    {
        return Category::all();
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->category_id = $product->category_id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
    }

    public function update()
    {
        try {
            $this->validate();

            $data = [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'stock' => $this->stock,
            ];

            if ($this->thumbnail) {
                $data['thumbnail'] = $this->thumbnail;
            }

            $this->productRepository->updateProduct($data, $this->product);

            Toaster::success('Product Telah di Update!');
        } catch (Exception $e) {
            Toaster::error('Validasi gagal: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.product.product-edit');
    }
}
