<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use App\Repository\CategoryRepository;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.dashboard'), Title('Edit Category')]
class CategoryEdit extends Component
{
    use WithFileUploads;

    public Category $category;

    #[Validate('required|string|min:5|max:255', message: 'Name Product harus di isi', translate: true)]
    public $name;

    #[Validate("nullable|image|mimes:jpeg,png,jpg|max:3048")]
    public $thumbnail;

    protected  $categoryRepository;

    public function __construct()
    {
        
        $this->categoryRepository = new CategoryRepository;
    }

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
    }

    public function update()
    {
        try {
            // Validasi input
            $this->validate();

            // Siapkan data untuk update
            $data = [
                'name' => $this->name,
            ];

            if ($this->thumbnail) {
                $data['thumbnail'] = $this->thumbnail;
            }

            $this->categoryRepository->updateCategory($data, $this->category);

            Toaster::success('Category berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Category Update Error: ' . $e->getMessage());
            Toaster::error('Gagal memperbarui kategori!');
        }
    }


    public function render()
    {
        return view('livewire.admin.category.category-edit');
    }
}
