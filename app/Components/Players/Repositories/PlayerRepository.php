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

    private function findPlayersList(int $userId): Builder
    {
        return $this->find()->where(['user_id' => $userId]);
    }

    private function find(): Builder
    {
        return Player::query();
    }
}
