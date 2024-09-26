<?php

declare(strict_types=1);

namespace App\Services\Prizes;

class LowPointsPrizeStrategy implements PrizeStrategyInterface
{
    public function getPrize(int $points): float
    {
        return $points * 0.1;
    }
}
