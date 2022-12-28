<?php

namespace App\Components\Teams\services;

use App\Components\Players\Models\Player;
use App\Components\Teams\Exceptions\QuantityPlayersNotMatchException;
use App\Components\Teams\models\dto\TeamDto;
use App\Components\Teams\models\dto\TeamGroupDto;
use App\Components\Teams\models\views\TeamGroupView;
use App\Components\Teams\models\views\TeamView;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class DistributionPlayersByTeams
{
    private array $players;

    private TeamGroupDto $teamGroupDto;
    private TeamGroupView $teamGroupView;

    /**
     * @param Player[] $players
     */
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
        $index = random_int(0, count($this->players));
        $randomPlayer = $this->players[$index] ?? null;

        if (!$randomPlayer instanceof Player) {
            unset($this->players[$index]);
        }

        return $randomPlayer;
    }
}
