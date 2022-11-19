<?php

namespace App\Components\Teams\models\views;

use App\Components\Players\Models\Player;

class TeamView
{
    /** @var Player[] $activePlayers */
    public array $activePlayers;

    /** @var Player[] $reservePlayers */
    public array $reservePlayers;

    public int $quantityActivePlayers = 0;
    public int $quantityReservePlayers = 0;
}
