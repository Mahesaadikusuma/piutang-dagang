<?php

namespace App\Livewire\Admin\Transaction;

use App\Repository\TransactionRepository;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Transaction List')]
class HistoryList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    #[Url()]
    public $limit = 5;

    #[Url(history:true)]
    public $sortBy = 'id';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    protected $transactionRepository;
    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
    }


    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    #[Computed(persist: true)]
    public function HistoryUser()
    {
        return $this->transactionRepository->getHistoryByUser($this->search, $this->limit, $this->sortBy,$this->sortDir);
    }

    public function render()
    {
        $heads = ['No', 'Kode Transaction', 'UserName', 'Product', 'Quantity', 'Jenis Pembayaran' , 'Transaction Total' ,'Status', 'Created At', 'action'];
        return view('livewire.admin.transaction.history-list', [
            'heads' => $heads
        ]);
    }
}
