<?php

declare(strict_types=1);

namespace App\Repositories\LuckyHistory;

use App\Models\LuckyHistory;
use App\Models\Player;

interface LuckyHistoryRepositoryInterface
{
    public function getRecentHistory(Player $player, int $limit = 3);

    public function createHistory(array $data): LuckyHistory;

    public function find(int $id): ?LuckyHistory;
}
