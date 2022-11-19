<?php

namespace App\Components\Teams\services;

use App\Components\Players\Services\PlayersService;
use App\Components\Teams\models\views\TeamGroupView;
use App\Components\Teams\TeamGroupConfig;

class TeamsService
{
    private PlayersService $playersService;
    private TeamGroupConfig $teamGroupConfig;

    public function __construct(
        PlayersService $playersService,
        TeamGroupConfig $teamGroupConfig,
    ) {
        $this->playersService = $playersService;
        $this->teamGroupConfig = $teamGroupConfig;
    }

    /** @return TeamGroupView[] */
    public function getUserTeamsSize(int $userId): array
    {
        return $this->teamGroupConfig->getTeamGroup(
            $this->playersService->countActivePlayersUser($userId)
        );
    }
}
