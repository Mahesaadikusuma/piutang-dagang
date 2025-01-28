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

    #[Url]
    public $search = '';

    #[Url()]
    public $limit = 5;

    #[Url(history:true)]
    public $sortBy = 'id';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    protected $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }


    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

   
    #[On('category-deleted')] 
    public function render()
    {
        $heads = ['No','Name', 'Slug', 'Thumbnail'];     
        $categories = $this->categoryRepository->getCategories($this->search, $this->limit, $this->sortBy,$this->sortDir);

        return view('livewire.admin.category.category-list',[
            'categories' => $categories,
            'heads' => $heads
        ]);
    }
}
