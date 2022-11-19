<?php

namespace App\Http\Controllers\Api;

use App\Components\Teams\services\TeamsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

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
}
