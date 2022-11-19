<?php

namespace App\Components\Teams;

use App\Components\Teams\models\views\TeamGroupView;
use App\Components\Teams\models\views\TeamView;

class TeamGroupConfig
{
    /**
     * @return TeamGroupView[]
     */
    public function getTeamGroup(int $quantityPlayers): array
    {
        $TeamGroupViews = [];

        switch ($quantityPlayers) {
            case 3:
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(1);
                $teamGroup->teams[] = $this->getTeam(2);

                $TeamGroupViews[] = $teamGroup;
                break;
            case 4:
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(2);
                $teamGroup->teams[] = $this->getTeam(2);

                $TeamGroupViews[] = $teamGroup;
                break;
            case 5:
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(2);
                $teamGroup->teams[] = $this->getTeam(3);

                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(2, 1);
                $teamGroup->teams[] = $this->getTeam(2);

                $TeamGroupViews[] = $teamGroup;
                break;
        }

        return $TeamGroupViews;
    }

    private function getTeam(int $activePlayers, int $reservePlayers = 0): TeamView
    {
        $teamView = new TeamView();
        $teamView->quantityActivePlayers = $activePlayers ;
        $teamView->quantityReservePlayers = $reservePlayers;

        return $teamView;
    }
}
