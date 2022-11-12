<?php

namespace App\Http\Controllers;

use App\Components\Api\Services\ApiResponseService;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getAuthUser(): User
    {
        return Auth::user();
    }

    protected function apiResponse(): ApiResponseService
    {
        return new ApiResponseService();
    }
}
