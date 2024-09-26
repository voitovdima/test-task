<?php

declare(strict_types=1);

namespace App\Repositories\LuckyHistory;

use App\Models\LuckyHistory;
use App\Models\Player;

class LuckyHistoryRepository implements LuckyHistoryRepositoryInterface
{
    public function getRecentHistory(Player $player, int $limit = 3)
    {
        return LuckyHistory::where('player_id', $player->getId())
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function createHistory(array $data): LuckyHistory
    {
        return LuckyHistory::create($data);
    }

    public function find(int $id): ?LuckyHistory
    {
        return LuckyHistory::find($id);
    }
}
