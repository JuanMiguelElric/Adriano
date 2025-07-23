<?php

namespace App\Interfaces\Repositories;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function create(array $data): Transaction;
}
