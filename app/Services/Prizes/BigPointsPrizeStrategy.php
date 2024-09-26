<?php

declare(strict_types=1);

namespace App\Services\Prizes;

class BigPointsPrizeStrategy implements PrizeStrategyInterface
{
    public function getPrize(int $points): float
    {
        return $points * 0.5;
    }
}
