<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use App\Repository\CategoryRepository;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.dashboard')]
#[Title('Category Delete')]
class CategoryDelete extends Component
{
    public Category $category;
    protected $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public $showModal = false;

    public function mount()
    {
        $this->category->name;
    }

    public function delete_confirm() {
        $this->showModal = true;
    }

    public function delete()
    {        
        try {
            $this->categoryRepository->deleteCategory($this->category);
            Toaster::success('Category berhasil dihapus!');
            $this->dispatch("category-deleted"); 
        } catch (\Exception $e) {
            Toaster::error('Validasi Error: ' . $e->getMessage());
        }
        return $this->redirect('/admin/category', navigate:true);
    }

    public function render()
    {
        return view('livewire.admin.category.category-delete');
    }
}
