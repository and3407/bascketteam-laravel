<?php

namespace App\Http\Controllers\Api;

use App\Components\Players\Models\Dto\PlayerDto;
use App\Components\Players\Services\PlayersService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    private PlayersService $playersService;

    public function __construct(
        PlayersService $playersService
    ) {
        $this->playersService = $playersService;
    }

    public function addPlayer(Request $request): JsonResponse
    {
        $validation = $request->validate([
            'name' => 'required|max:255',
            'high' => 'required|bool',
            'active' => 'required|bool',
        ]);

        $playerDto = new PlayerDto(
            $this->getAuthUser()->id,
            $validation['name'],
            $validation['high'],
            $validation['active']
        );

        $player = $this->playersService->createPlayer($playerDto);

        return response()->json($player);
    }
}
