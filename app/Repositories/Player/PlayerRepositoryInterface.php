<?php

declare(strict_types=1);

namespace App\Repositories\Player;

use App\Models\Player;
use DateTime;
use Illuminate\Http\Request;

interface PlayerRepositoryInterface
{
    public function findByUniqueLink(string $uniqueLink): ?Player;

    public function create(
        Request $request,
        string $uniqueLink,
        DateTime $expiresAt
    ): Player;

    public function regenerateLink(
        Player $player,
        string $uniqueLink,
        DateTime $expiresAt
    ): void;

    public function deactivate(Player $player): void;
}
