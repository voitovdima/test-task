<?php

declare(strict_types=1);

namespace App\Services\Prizes;

class PrizeService
{
    protected $strategies;

    public function __construct()
    {
        $this->strategies = [
            'high' => new HighPointsPrizeStrategy(),
            'big' => new BigPointsPrizeStrategy(),
            'medium' => new MediumPointsPrizeStrategy(),
            'low' => new LowPointsPrizeStrategy(),
        ];
    }

    public function getPrize(int $points): float
    {
        if ($points > 900) {
            return $this->strategies['high']->getPrize($points);
        } elseif ($points > 600) {
            return $this->strategies['big']->getPrize($points);
        } elseif ($points > 300) {
            return $this->strategies['medium']->getPrize($points);
        } else {
            return $this->strategies['low']->getPrize($points);
        }
    }
}
