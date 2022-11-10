<?php

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

Route::middleware('guest')->prefix('/users')->group(function() {
    Route::post('register', [UsersController::class, 'register']);
    Route::post('token', [UsersController::class, 'getToken'])->middleware(['auth.basic.once']);;
});

Route::post('/players/add', function () {
    return json_encode(['ok']);
})->middleware(['auth:sanctum']);

Route::get('unauth', function () {
    return response('Unauthorized', 401);
})->name('unauth');
