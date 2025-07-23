<?php

namespace App\Strategies;

interface TransactionStrategyInterface
{
    public function execute(object $dados): void;
}
