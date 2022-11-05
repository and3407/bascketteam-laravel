<?php

use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules;

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
    Route::post('register', [UserController::class, 'register']);
});

Route::get('/user', function () {
    return json_encode(['ok']);
})->middleware(['auth:sanctum']);

Route::get('unauth', function () {
    return response('Unauthorized', 401);
})->name('unauth');
