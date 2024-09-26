<?php

declare(strict_types=1);

namespace App\Services\Prizes;

class HighPointsPrizeStrategy  implements PrizeStrategyInterface
{
    public function getPrize(int $points): float
    {
        return $points * 0.7;
    }
}
