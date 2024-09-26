<?php

namespace App\Services\Prizes;

interface PrizeStrategyInterface
{
    public function getPrize(int $points): float;
}
