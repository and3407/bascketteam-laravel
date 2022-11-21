<?php

namespace App\Components\Teams\services;

use App\Components\Players\Services\PlayersService;
use App\Components\Teams\models\dto\TeamGroupDto;
use App\Components\Teams\models\views\TeamGroupView;
use App\Components\Teams\TeamGroupConfig;

class TeamsService
{
    private DistributionPlayersByTeams $distributionPlayersByTeams;
    private PlayersService $playersService;
    private TeamGroupConfig $teamGroupConfig;

    public function __construct(
        DistributionPlayersByTeams $distributionPlayersByTeams,
        PlayersService $playersService,
        TeamGroupConfig $teamGroupConfig,
    ) {
        $this->distributionPlayersByTeams = $distributionPlayersByTeams;
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

    public function getTeams(int $userId, TeamGroupDto $teamGroupDto): TeamGroupView
    {
        return $this
            ->distributionPlayersByTeams
            ->setPlayers($this->playersService->getActivePlayersUser($userId))
            ->setTeamGroupDto($teamGroupDto)
            ->distribute();
    }
}
