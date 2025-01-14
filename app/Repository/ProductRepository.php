<?php

namespace App\Repository;

use App\Interface\ProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductInterface
{
    protected $ProductModel;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->ProductModel = new Product();
    }

    public function getAll()
    {
        return $this->ProductModel->with(['category'])->all();
    }

    public function getProductLimit($limit = 10)
    {
        return $this->ProductModel
            ->with(['category'])
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getPaginatedProducts($search, $limit = 10)
    {
        return $this->ProductModel
            ->with('category')
            ->where('name', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function getProduct($id)
    {
        
    }

    public function getOtherProducts($slug)
    {
        return $this->ProductModel->with(['category'])->where('slug', "!=", $slug)->take(5)->get();
    }

    public function createProduct($data)
    {
        return $this->ProductModel->create($data);
    }

    public function updateProduct($data, $product)
    {
        if (isset($data['thumbnail'])) {
            // Hapus thumbnail lama jika ada
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Simpan thumbnail baru
            $data['thumbnail'] = $data['thumbnail']->storeAs('product/thumbnail', $data['thumbnail']->hashName(), 'public');
        }

        // Perbarui produk
        $product->update($data);

        return $product;
    }

    public function deleteProduct($productId)
    {
        if ($productId->thumbnail && Storage::disk('public')->exists($productId->thumbnail)) {
            Storage::disk('public')->delete($productId->thumbnail);
        }

        return $productId->delete();
    }
}
