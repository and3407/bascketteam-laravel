<?php

namespace App\Http\Controllers\Api;

use App\Components\Players\Exception\PlayerNotFoundException;
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

        return $this
            ->apiResponse()
            ->setData($this->playersService->createPlayer($playerDto))
            ->ok();
    }

    public function getPlayersList(): JsonResponse
    {
        return $this
            ->apiResponse()
            ->setData($this->playersService->getPlayersList($this->getAuthUser()->id))
            ->ok();
    }

    public function deletePlayer(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'player_id' => 'required|int',
        ]);

        try {
            $this->playersService->deletePlayerByIdAndUserId(
                $validated['player_id'],
                $this->getAuthUser()->id
            );
        } catch (PlayerNotFoundException $exception) {
            return $this
                ->apiResponse()
                ->setMessage($exception->getMessage())
                ->notFound();
        }

        return $this
            ->apiResponse()
            ->ok();
    }

    public function updatePlayer(Request $request): JsonResponse
    {
        $validation = $request->validate([
            'name' => 'required|max:255',
            'high' => 'required|bool',
            'active' => 'required|bool',
            'id' => 'required|int',
        ]);

        $playerDto = new PlayerDto(
            $this->getAuthUser()->id,
            $validation['name'],
            $validation['high'],
            $validation['active'],
            $validation['id']
        );

        try {
            $this->playersService->updatePlayerByIdAndUserId($playerDto);
        }catch (PlayerNotFoundException $exception) {
            return $this
                ->apiResponse()
                ->setMessage($exception->getMessage())
                ->notFound();
        }

        return $this
            ->apiResponse()
            ->ok();
    }
}
