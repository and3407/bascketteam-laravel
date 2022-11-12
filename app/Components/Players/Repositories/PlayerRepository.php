<?php

namespace App\Components\Players\Repositories;

use App\Components\Players\Models\Dto\PlayerDto;
use App\Components\Players\Models\Player;

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
}
