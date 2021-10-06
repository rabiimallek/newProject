<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\etudiantController;
use App\Http\Controllers\AuthController;
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




Route::group(['middleware' =>  ['authorization' ]   ],function ()
{
    Route::post('get',[etudiantController::class, 'get']);
    Route::post('add',[etudiantController::class, 'add']);
    Route::post('update',[etudiantController::class, 'update']);
    Route::post('delete',[etudiantController::class, 'delete']);

});


Route::group([

    'middleware' => ['checkAdmin', 'api' ] ,
    'prefix' => 'auth'


], function ($router) {
    Route::post('login',[AuthController::class, 'login']);
    Route::post('newUser',[AuthController::class, 'newUser']);
    Route::post('me',[AuthController::class, 'me']);


    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
   // Route::post('me', 'AuthController@me');

});
