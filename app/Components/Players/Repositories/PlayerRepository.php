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
        return $this->findPlayersUser($userId)->get()->toArray();
    }

    public function existsPlayerByIdAndUserId(int $playerId, int $userId): bool
    {
        return $this->findPlayerByIdAndUserId($playerId, $userId)->exists();
    }

    public function getPlayerByIdAndUserId(int $playerId, int $userId): ?Player
    {
        return $this->findPlayerByIdAndUserId($playerId, $userId)->first();
    }

    public function deletePlayerById(int $playerId): void
    {
        $this->getQuery()->find($playerId)->delete();
    }

    public function updatePlayer(Player $player): void
    {
        $player->save();
    }

    public function countActivePlayersUser(int $user): int
    {
        return $this->findActivePlayersUser($user)->count();
    }

    private function findActivePlayersUser(int $userId): Builder
    {
        return $this
            ->findPlayersUser($userId)
            ->where(['active' => true]);
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

    private function findPlayersUser(int $userId): Builder
    {
        return $this->getQuery()->where(['user_id' => $userId]);
    }

    private function getQuery(): Builder
    {
        return Player::query();
    }
}
