<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Repository\CategoryRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.dashboard'), Title('Create Category')]
class CategoryCreate extends Component
{
    use WithFileUploads;
    public Category $category;

    protected $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    #[Validate('required|string|min:5|max:255',  message: 'Name Product harus di isi', translate: true)]
    public $name;

    #[Validate('required|image|mimes:jpg,jpeg,png|max:2048',  message: 'Thumbnail Harus di isi', translate: true)]
    public $thumbnail;


    public function save()
    {
        $this->validate();
        $thumbnailPath = $this->thumbnail->storeAs('category/thumbnail', $this->thumbnail->hashName(), 'public');
        $data = [
            'name' => $this->name,
            'thumbnail' => $thumbnailPath
        ];
        $this->categoryRepository->createCategory($data);
        $this->reset('name', 'thumbnail');
        $this->redirect('/admin/category', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.category.category-create');
    }
}
