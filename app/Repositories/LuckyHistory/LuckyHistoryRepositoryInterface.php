<?php

declare(strict_types=1);

namespace App\Repositories\LuckyHistory;

use App\Models\Player;

interface LuckyHistoryRepositoryInterface
{
    public function getRecentHistory(Player $player, $limit = 3);

    public function createHistory(array $data);

    public function find($id);
}
