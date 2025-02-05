<?php

namespace App\Repository;

use App\Interface\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Masmerise\Toaster\Toaster;

class CategoryRepository implements CategoryInterface
{
    protected $CategoryModel;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->CategoryModel = new Category();
    }

    public function getAll()
    {
        return $this->CategoryModel->all();
    }

    public function getCategories($search, $limit = 10, $sortBy = 'id', $sortDir = 'DESC')
    {
        $categories = $this->CategoryModel
            ->where('name', 'like', '%' . $search . '%')
            ->orderBy($sortBy, $sortDir)
            ->paginate($limit);

        if ($search) {
            if ($categories->isNotEmpty()) {
                Toaster::success("Data yang dicari ditemukan.");
            } else {
                Toaster::error("Data yang dicari tidak ditemukan.");
            }
        }

        return $categories;
    }

    public function getCategoryDetail($id)
    {
        
    }

    public function createCategory($data)
    {
        return $this->CategoryModel->create($data);
    }

    public function updateCategory($data, $Category)
    {
        if (isset($data['thumbnail'])) {
            if ($Category->thumbnail && Storage::disk('public')->exists($Category->thumbnail)) {
                Storage::disk('public')->delete($Category->thumbnail);
            }

            $data['thumbnail'] = $data['thumbnail']->storeAs('category/thumbnail', $data['thumbnail']->hashName(), 'public');
        }
        $Category->update($data);

        return $Category;
    }


    public function deleteCategory($categoryId)
    {
        if ($categoryId->thumbnail && Storage::disk('public')->exists($categoryId->thumbnail)) {
            Storage::disk('public')->delete($categoryId->thumbnail);
        }

        return $categoryId->delete();
    }
}
