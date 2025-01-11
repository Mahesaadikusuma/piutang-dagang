<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Repository\CategoryRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('category List')]
class CategoryList extends Component
{
    use WithPagination;
    protected $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    #[Url]
    public $search = '';

    public $limit = 20;

    #[On('category-deleted')] 
    public function render()
    {
        $heads = ['No','Name', 'Slug', 'Thumbnail'];

        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->limit);   

        $this->categoryRepository->getCategories($this->search, $this->limit);

        return view('livewire.admin.category.category-list',[
            'categories' => $categories,
            'heads' => $heads
        ]);
    }
}
