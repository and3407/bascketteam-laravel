<?php

namespace App\Http\Controllers\Api;

use App\Components\Teams\models\dto\TeamDto;
use App\Components\Teams\models\dto\TeamGroupDto;
use App\Components\Teams\models\views\TeamView;
use App\Components\Teams\services\TeamsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    private TeamsService $teamsService;

    public function __construct(
        TeamsService $teamsService
    ) {
        $this->teamsService = $teamsService;
    }

    public function getTeamsSize(): JsonResponse
    {
        $user = $this->getAuthUser();

        return $this
            ->apiResponse()
            ->setData($this->teamsService->getUserTeamsSize($user->id))
            ->ok();
    }

    public function getTeams(Request $request): JsonResponse
    {
        $validation = $request->validate([
            'teams.*.quantityActivePlayers' => 'required|int',
            'teams.*.quantityReservePlayers' => 'required|int',
        ]);

        $teamGroupDto = new TeamGroupDto();
        foreach ($request->input('teams') as $team) {
            $teamDto = new TeamDto();
            $teamDto->setQuantityActivePlayers($team['quantityActivePlayers']);
            $teamDto->setQuantityReservePlayers($team['quantityReservePlayers']);

            $teamGroupDto->appendTeamDto($teamDto);
        }

        return $this
            ->apiResponse()
            ->setData($this->teamsService->getTeams($this->getAuthUser()->id, $teamGroupDto))
            ->ok();
    }
}
