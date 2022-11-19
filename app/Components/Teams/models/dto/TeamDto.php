<?php

namespace App\Components\Teams\models\dto;

class TeamDto
{
    private int $quantityActivePlayers = 0;
    private int $quantityReservePlayers = 0;

    public function getQuantityActivePlayers(): int
    {
        return $this->quantityActivePlayers;
    }

    public function setQuantityActivePlayers(int $quantityActivePlayers): void
    {
        $this->quantityActivePlayers = $quantityActivePlayers;
    }

    public function getQuantityReservePlayers(): int
    {
        return $this->quantityReservePlayers;
    }

    public function setQuantityReservePlayers(int $quantityReservePlayers): void
    {
        $this->quantityReservePlayers = $quantityReservePlayers;
    }
}
