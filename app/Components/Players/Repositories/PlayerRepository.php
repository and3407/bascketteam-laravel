<?php

namespace App\Components\Players\Repositories;

use App\Components\Players\Models\Dto\PlayerDto;
use App\Components\Players\Models\Player;
use Illuminate\Database\Eloquent\Builder;

class PlayerRepository
{
    public function createPlayer(PlayerDto $playerDto)
    {
        return Player::create([
            'user_id' => $playerDto->getUserId(),
            'name' => $playerDto->getName(),
            'high' => $playerDto->isHigh(),
            'active' => $playerDto->isActive()
        ]);
    }

    /**
     * @return Player[]
     */
    public function getPlayersList(int $userId): array
    {
        return $this->findPlayersList($userId)->get()->toArray();
    }

    public function getPlayerByIdAndUserId(int $playerId, int $userId): ?Player
    {
        $player = $this->findPlayerByIdAndUserId($playerId, $userId)->first();

        return ($player instanceof Player) ? $player : null;
    }

    public function deletePlayerById(int $playerId): void
    {
        $this->getQuery()->find($playerId)->delete();
    }

    private function findPlayerByIdAndUserId(int $playerId, int $userId): Builder
    {
        return $this
            ->getQuery()
            ->where([
                'id' => $playerId,
                'user_id' => $userId
            ]);
    }

    private function findPlayersList(int $userId): Builder
    {
        return $this->getQuery()->where(['user_id' => $userId]);
    }

    private function getQuery(): Builder
    {
        return Player::query();
    }
}
