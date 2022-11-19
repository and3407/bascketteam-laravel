<?php

namespace App\Components\Teams\models\dto;

use App\Components\Teams\models\dto\TeamDto;

class TeamGroupDto
{
    /** @var TeamDto[] $teams */
    private array $teamDto;

    /** @return TeamDto[] */
    public function getTeams(): array
    {
        return $this->teamDto;
    }

    public function appendTeamDto(TeamDto $teamDto): void
    {
        $this->teamDto[] = $teamDto;
    }
}
