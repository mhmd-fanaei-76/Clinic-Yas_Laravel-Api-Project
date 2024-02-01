<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function (){
    Route::delete('user/logout',[AuthController::class,'logout']);

    Route::group(['middleware' => [RoleMiddleware::using('admin')]], function () {
        Route::post('user/create',[UserController::class,'createUser']);
        Route::delete('user/delete/{user}',[UserController::class,'deleteUser']);
    });
});



Route::post('user/register',[AuthController::class,'register']);
Route::post('user/login',[AuthController::class,'login']);
