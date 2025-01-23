<?php

namespace App\Interface;

interface PiutangInterface
{
    public function getAll();
    public function getPaginatedPiutang(?string $search, int $limit);
    public function getHistoryPiutangByUser(?string $search, int $limit);
}
