<?php

namespace App\Livewire\Admin\Transaction;

use App\Repository\TransactionRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Transaction List')]
class TransactionList extends Component
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

    public function render()
    {
        $heads = ['No', 'Kode Transaction', 'UserName', 'Product', 'Quantity', 'Jenis Pembayaran' , 'Transaction Total', 'cicilan', 'awal tempo', 'akhir jatuh tempo' ,'Status', 'Created At', 'action'];
        $transactions = $this->transactionRepository->getPaginatedUsers($this->search, $this->limit);
        return view('livewire.admin.transaction.transaction-list', [
            'heads' => $heads,
            'transactions' => $transactions
        ]);
    }
}
