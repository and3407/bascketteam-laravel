<?php

namespace App\Components\Teams\services;

use App\Components\Players\Models\Player;
use App\Components\Teams\Exceptions\QuantityPlayersNotMatchException;
use App\Components\Teams\models\dto\TeamDto;
use App\Components\Teams\models\dto\TeamGroupDto;
use App\Components\Teams\models\views\TeamGroupView;

class DistributionPlayersByTeams
{
    /** @var Player[] $players */
    private array $players;

    private TeamGroupDto $teamGroupDto;
    private TeamGroupView $teamGroupView;

    /** @param Player[] $players */
    public function setPlayers(array $players): self
    {
        $this->players = $players;

        return $this;
    }

    public function setTeamGroupDto(TeamGroupDto $teamGroupDto): self
    {
        $this->teamGroupDto = $teamGroupDto;

        return $this;
    }

    public function distribute(): TeamGroupView
    {
        $this->teamGroupView = new TeamGroupView();

        $teams = $this->teamGroupDto->getTeams();

        $totalPlayersTeam = 0;
        foreach ($teams as $team) {
            $totalPlayersTeam += $team->getQuantityActivePlayers() + $team->getQuantityReservePlayers();
        }

        if (count($this->players) != $totalPlayersTeam) {
            throw new QuantityPlayersNotMatchException();
        }

        foreach ($teams as $team) {
            $this->fillTeam($team);
        }

        return $this->teamGroupView;
    }

    private function fillTeam(TeamDto $teamDto): void
    {

    }
}
