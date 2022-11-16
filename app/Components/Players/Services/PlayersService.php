<?php

namespace App\Components\Players\Services;

use App\Components\Players\Exception\PlayerNotFoundException;
use App\Components\Players\Models\Dto\PlayerDto;
use App\Components\Players\Models\Player;
use App\Components\Players\Repositories\PlayerRepository;

class PlayersService
{
    private PlayerRepository $playerRepository;

    public function __construct(
        PlayerRepository $playerRepository
    ) {
        $this->playerRepository = $playerRepository;
    }

    public function createPlayer(PlayerDto $playerDto): Player {
        return $this->playerRepository->createPlayer($playerDto);
    }

    /**
     * @return Player[]
     */
    public function getPlayersList(int $userId): array
    {
        return $this->playerRepository->getPlayersList($userId);
    }

    public function existsPlayerByIdAndUserId(int $playerId, int $userId): bool
    {
        return $this->playerRepository->existsPlayerByIdAndUserId($playerId, $userId);
    }

    /**
     * @throws PlayerNotFoundException
     */
    public function deletePlayerByIdAndUserId(int $playerId, int $userId): void
    {
        if (!$this->existsPlayerByIdAndUserId($playerId, $userId)) {
            throw new PlayerNotFoundException();
        }

        $this->playerRepository->deletePlayerById($playerId);
    }
}
