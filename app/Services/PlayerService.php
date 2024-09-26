<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Player;
use App\Repositories\LuckyHistory\LuckyHistoryRepositoryInterface;
use App\Repositories\Player\PlayerRepositoryInterface;
use App\Services\Prizes\PrizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PlayerService
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

    public function createPlayer(Request $request): Player
    {
        $uniqueLink = Str::random(32);
        $expiresAt = Carbon::now()->addDays(7);

        return $this->playerRepository->create($request, $uniqueLink, $expiresAt);
    }

    public function regenerateLink(Player $player): string
    {
        $uniqueLink = Str::random(32);
        $expiresAt = Carbon::now()->addDays(7);

        $this->playerRepository->regenerateLink($player, $uniqueLink, $expiresAt);

        return $uniqueLink;
    }

    public function deactivate(Player $player): void
    {
       $this->playerRepository->deactivate($player);
    }
}
