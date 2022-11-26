<?php

namespace App\Components\Players\Services;

use App\Components\Players\Exception\PlayerNotFoundException;
use App\Components\Players\Models\Dto\PlayerDto;
use App\Components\Players\Models\Player;
use App\Components\Players\Repositories\PlayerRepository;
use Illuminate\Database\Eloquent\Collection;

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
    public function getPlayersUser(int $userId): array
    {
        return $this->playerRepository->getPlayersUser($userId);
    }

    public function getActivePlayersUser(int $userId): Collection
    {
        return $this->playerRepository->getActivePlayersUser($userId);
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

    /**
     * @throws PlayerNotFoundException
     */
    public function updatePlayerByIdAndUserId(PlayerDto $playerDto): void
    {
        $player = $this->playerRepository->getPlayerByIdAndUserId($playerDto->getId(), $playerDto->getUserId());

        if (!$player instanceof Player) {
            throw new PlayerNotFoundException();
        }

        $player->name = $playerDto->getName();
        $player->high = $playerDto->isHigh();
        $player->active = $playerDto->isActive();

        $this->playerRepository->updatePlayer($player);
    }

    public function countActivePlayersUser(int $userId): int
    {
        return $this->playerRepository->countActivePlayersUser($userId);
    }
}
