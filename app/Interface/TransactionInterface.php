<?php

namespace App\Interface;

use App\Models\User;

interface TransactionInterface
{
    public function getAll();
    public function getPaginatedUsers(?string $search, int $limit);
    public function getHistoryByUser(?string $search, int $limit);
}
