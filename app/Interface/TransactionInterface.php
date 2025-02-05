<?php

namespace App\Interface;

use App\Models\User;

interface TransactionInterface
{
    public function getAll();
    public function getPaginatedTransactions(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC');
    public function getHistoryByUser(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC');
}
