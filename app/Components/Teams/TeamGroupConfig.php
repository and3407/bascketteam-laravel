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
            case 3: //1-2
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(1);
                $teamGroup->teams[] = $this->getTeam(2);

                $TeamGroupViews[] = $teamGroup;
                break;
            case 4: //2-2
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(2);
                $teamGroup->teams[] = $this->getTeam(2);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 5: //2-3, 2/1-2
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(2);
                $teamGroup->teams[] = $this->getTeam(3);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(2, 1);
                $teamGroup->teams[] = $this->getTeam(2);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 6: //3-3
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(3);
                $teamGroup->teams[] = $this->getTeam(3);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 7: //3-4, 3/1-3
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(3);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(3, 1);
                $teamGroup->teams[] = $this->getTeam(3);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 8: //4-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 9: //4-5, 4/1-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(5);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 10: //5-5, 4/1-4/1
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 11: //5/1-5, 4-4-3, 3/1-3/1-3
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $teamGroup->teams[] = $this->getTeam(5);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(3);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(3, 1);
                $teamGroup->teams[] = $this->getTeam(3, 1);
                $teamGroup->teams[] = $this->getTeam(3);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 12: //5/1-5/1, 4-4-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 13: //4/1-4-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 14: //5-5-4, 4/1-4/1-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 15: //5-5-5, 4/1-4/1-4/1
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 16: //5/1-5-5, 4-4-4-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 17: //5/1-5/1-5, 4/1-4-4-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $teamGroup->teams[] = $this->getTeam(5);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 18: //5-5-4-4, 5/1-5/1-5/1, 4/1-4/1-4-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $teamGroup->teams[] = $this->getTeam(5, 1);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 19: //5-5-5-4, 4/1-4/1-4/1-4
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4);
                $TeamGroupViews[] = $teamGroup;
                break;
            case 20: //5-5-5-5, 4/1-4/1-4/1-4/1
                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $teamGroup->teams[] = $this->getTeam(5);
                $TeamGroupViews[] = $teamGroup;

                $teamGroup = new TeamGroupView();
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
                $teamGroup->teams[] = $this->getTeam(4, 1);
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
