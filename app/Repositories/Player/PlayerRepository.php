<?php

declare(strict_types=1);

namespace App\Repositories\Player;

use App\Models\Player;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function findByUniqueLink(string $uniqueLink): ?Player
    {
        return Player::where('unique_link', $uniqueLink)->firstOrFail();
    }

    public function deactivate($player): void
    {
        $player->setExpiresAt(Carbon::now());
        $player->save();
    }

    public function create(Request $request, string $uniqueLink, DateTime $expiresAt): Player
    {
        return Player::create([
            'username' => $request->username,
            'phonenumber' => $request->phonenumber,
            'unique_link' => $uniqueLink,
            'expires_at' => $expiresAt,
        ]);
    }

    public function regenerateLink(Player $player, $uniqueLink, DateTime $expiresAt): void
    {
        $player->setUniqueLink($uniqueLink);
        $player->setExpiresAt($expiresAt);

        $player->save();
    }
}
