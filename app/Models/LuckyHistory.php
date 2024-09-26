<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyHistory extends Model
{
    protected $fillable = [
        'player_id',
        'random_number',
        'result',
        'win_amount',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
