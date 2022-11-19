<?php

use App\Http\Controllers\Api\PlayersController;
use App\Http\Controllers\Api\TeamsController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('users')->group(function() {
    Route::post('register', [UsersController::class, 'register'])->middleware('guest');
    Route::post('token', [UsersController::class, 'getToken'])->middleware(['auth.basic.once']);
    Route::get('name', [UsersController::class, 'getName'])->middleware(['auth:sanctum']);
});

Route::middleware(['auth:sanctum'])->prefix('players')->group(function() {
    Route::post('add', [PlayersController::class, 'addPlayer']);
    Route::post('delete', [PlayersController::class, 'deletePlayer']);
    Route::post('update', [PlayersController::class, 'updatePlayer']);
    Route::get('list', [PlayersController::class, 'getPlayersList']);
});

Route::middleware(['auth:sanctum'])->prefix('teams')->group(function() {
    Route::post('teams-size', [TeamsController::class, 'getTeamsSize']);
    Route::post('get-teams', [TeamsController::class, 'getTeams']);
});

Route::get('unauth', function () {
    return response('Unauthorized', 401);
})->name('unauth');
