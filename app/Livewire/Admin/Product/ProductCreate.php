<?php

namespace App\Livewire\Admin\Product;

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
#[Title('Product Create')]
class ProductCreate extends Component
{
    use WithFileUploads;
    public Product $product;

    #[Validate("required|exists:categories,id")]
    public $category_id;
    
    #[Validate('required|string|min:5|max:255',  message: 'Name Product harus di isi', translate: true)]
    public $name;

    #[Validate("required|string|min:5")]
    public $description;

    #[Validate("required|image|mimes:jpeg,png,jpg|max:3048")]
    public $thumbnail;
    
    #[Validate("required|integer")]
    public $price;

    #[Validate("required|integer")]
    public $stock;

    protected $productRepository;
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }
    

    #[Computed()]
    public function categories()
    {
        return Category::all();
    }

    public function save()
    {
        try {
            $this->validate();
            $thumbnailPath = $this->thumbnail->storeAs('product/image', $this->thumbnail->hashName(), 'public');
            $this->productRepository->createProduct([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'description' => $this->description,
                'thumbnail' => $thumbnailPath,
                'price' => $this->price,
                'stock' => $this->stock,
            ]);
            $this->reset([
                'category_id',
                'name',
                'description',
                'thumbnail',
                'price',
                'stock',
                'thumbnail' 
            ]);
            Toaster::success('Product Telah di Tambahkan!');
        } catch (Exception $e) {
            Toaster::error('validasi: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.product.product-create');
    }
}
