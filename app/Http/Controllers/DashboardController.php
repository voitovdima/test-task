<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\LuckyHistory\LuckyHistoryRepositoryInterface;
use App\Repositories\Player\PlayerRepositoryInterface;
use App\Services\DashboardService;
use App\Services\PlayerService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    protected $playerRepository;
    protected $luckyHistoryRepository;
    protected $dashboardService;
    protected $playerService;

    public function __construct(
        LuckyHistoryRepositoryInterface $luckyHistoryRepository,
        PlayerRepositoryInterface $playerRepository,
        DashboardService $dashboardService,
        PlayerService $playerService
    ) {
        $this->luckyHistoryRepository = $luckyHistoryRepository;
        $this->playerRepository = $playerRepository;
        $this->dashboardService = $dashboardService;
        $this->playerService = $playerService;
    }
    public function showSpecialPage($link)
    {
        $player = $this->playerRepository->findByUniqueLink($link);

        if (Carbon::now()->greaterThan($player->getExpiresAt())) {
            abort(404, 'Link expired');
        }

        return view('dashboard', compact('player'));
    }

    public function regenerateLink($link)
    {
        $player = $this->playerRepository->findByUniqueLink($link);
        $regenerateLink = $this->playerService->regenerateLink($player);

        return redirect()->route('dashboard', ['link' => $regenerateLink])
            ->with('success', 'Link regenerated successfully.');
    }

    public function deactivateLink($link)
    {
        $player = $this->playerRepository->findByUniqueLink($link);
        $this->playerService->deactivate($player);

        return redirect()->route('dashboard', ['link' => $player->getUniqueLink()])
            ->with('success', 'Link deactivated successfully.');
    }

    public function imFeelingLucky($link)
    {
        $player = $this->playerRepository->findByUniqueLink($link);
        $luckyhistories = $this->dashboardService->imFeelingLucky($player);

       return view('dashboard',  compact('player', 'luckyhistories'));
    }

    public function showHistory($link)
    {
        $player = $this->playerRepository->findByUniqueLink($link);
        $history =$this->dashboardService->getHistory($player);

        return view('dashboard', compact('player', 'history'));
    }
}
