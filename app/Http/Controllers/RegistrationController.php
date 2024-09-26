<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function showRegistrationForm()
    {
        return view('welcome');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:20',
        ]);

        $player = $this->playerService->createPlayer($request);

        return redirect()->route(
            'dashboard',
            [
                'link' => $player->getUniqueLink(),
            ]
        );
    }
}
