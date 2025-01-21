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
    public $limit = 30;

    protected $transactionRepository;
    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
    }

    #[Computed()]
    public function HistoryUser()
    {
        return $this->transactionRepository->getHistoryByUser($this->search, $this->limit);
    }

    public function render()
    {
        $heads = ['No', 'Kode Transaction', 'UserName', 'Product', 'Quantity', 'Jenis Pembayaran' , 'Transaction Total' ,'Status', 'Created At', 'action'];
        return view('livewire.admin.transaction.history-list', [
            'heads' => $heads
        ]);
    }
}
