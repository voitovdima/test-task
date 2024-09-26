<?php

namespace App\Services;

use App\Models\Player;
use App\Repositories\LuckyHistory\LuckyHistoryRepositoryInterface;
use App\Repositories\Player\PlayerRepositoryInterface;
use App\Services\Prizes\PrizeService;
use Illuminate\Support\Carbon;

class DashboardService
{
    protected $prizeService;
    protected $playerRepository;
    protected $luckyHistoryRepository;

    public function __construct(
        PrizeService $prizeService,
        PlayerRepositoryInterface $playerRepository,
        LuckyHistoryRepositoryInterface $luckyHistoryRepository
    ) {
        $this->prizeService = $prizeService;
        $this->playerRepository = $playerRepository;
        $this->luckyHistoryRepository = $luckyHistoryRepository;
    }

    public function imFeelingLucky(Player $player)
    {
        $randomNumber = rand(1, 1000);
        $win = $randomNumber % 2 === 0;
        $winAmount = 0;

        if ($win) {
            $winAmount = $this->prizeService->getPrize($randomNumber);
        }

        $result = $win ? 'Win' : 'Lose';

        return $this->luckyHistoryRepository->createHistory([
            'player_id' => $player->getId(),
            'random_number' => $randomNumber,
            'result' => $result,
            'win_amount' => $winAmount,
        ]);
    }

    public function getHistory(Player $player)
    {
        return $this->luckyHistoryRepository->getRecentHistory($player);
    }
}
