<?php

namespace App\Components\Teams\services;

use App\Components\Helpers\ArrayHelper;
use App\Components\Players\Models\Player;
use App\Components\Teams\Exceptions\QuantityPlayersNotMatchException;
use App\Components\Teams\models\dto\TeamDto;
use App\Components\Teams\models\dto\TeamGroupDto;
use App\Components\Teams\models\views\TeamGroupView;
use App\Components\Teams\models\views\TeamView;
use Illuminate\Database\Eloquent\Collection;

class DistributionPlayersByTeams
{
    private Collection $players;

    private TeamGroupDto $teamGroupDto;
    private TeamGroupView $teamGroupView;

    private ArrayHelper $arrayHelper;

    public function __construct(
        ArrayHelper $arrayHelper
    ) {
        $this->arrayHelper = $arrayHelper;
    }

    public function setPlayers(Collection $players): self
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
        $count = $teamDto->getQuantityActivePlayers() + $teamDto->getQuantityReservePlayers();
        $team = new TeamView();

        for ($i = 0; $i < $count; $i++) {
            $player = $this->getPlayerForFill();

            if (!$player instanceof Player) {
                continue;
            }

            if ($team->quantityActivePlayers < $teamDto->getQuantityActivePlayers()) {
                $team->activePlayers[] = $player;
                $team->quantityActivePlayers++;
            }

            if ($team->quantityReservePlayers < $teamDto->getQuantityReservePlayers()) {
                $team->reservePlayers[] = $player;
                $team->quantityReservePlayers++;
            }

            if ($team->quantityActivePlayers == $teamDto->getQuantityActivePlayers() &&
                $team->quantityReservePlayers == $teamDto->getQuantityReservePlayers()
            ) {
                break;
            }
        }

        $this->teamGroupView->teams[] = $team;
    }

    private function getPlayerForFill(): ?Player
    {
        $randomPlayer = $this->players->random();

        $this->players = $this->players->filter(function ($value) use ($randomPlayer) {
            return $value->id != $randomPlayer->id;
        });

        return $randomPlayer;
    }
}
