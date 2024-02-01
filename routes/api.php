<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\TurnController;
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
        Route::match(['put','patch'],'user/update/{user}',[UserController::class,'updateUser']);
        Route::get('user/admin',[UserController::class,'indexAdmin']);
        Route::get('user/doctor',[UserController::class,'indexDoctor']);

        Route::post('section/create',[SectionController::class,'createSection']);
        Route::get('section/get',[SectionController::class,'indexSection']);
        Route::delete('section/delete/{section}',[SectionController::class,'deleteSection']);
        Route::match(['put','patch'],'section/update/{section}',[SectionController::class,'updateSection']);

        Route::get('time/admin',[TimeController::class,'indexTime']);
        Route::match(['put','patch'],'time/update/{time}',[TimeController::class,'updateTime']);
        Route::delete('time/delete/{time}',[TimeController::class,'deleteTime']);

    });
    Route::group(['middleware' => [RoleMiddleware::using('doctor')]], function () {
        Route::post('time/create',[TimeController::class,'createTime']);

        Route::get('turn/get',[TurnController::class,'indexTurn']);
        Route::match(['put','patch'],'turn/update/{turn}',[TurnController::class,'updateTurn']);
        Route::delete('turn/delete',[TurnController::class,'deleteTurn']);

    });
});



Route::post('user/register',[AuthController::class,'register']);
Route::post('user/login',[AuthController::class,'login']);
Route::get('time',[TimeController::class,'index']);
