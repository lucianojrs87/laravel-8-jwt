<?php

use App\Http\Controllers\API\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\API\v1\ProtectedRouteAuth;
use App\Http\Controllers\Api\v1\UserController;

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

Route::get('/', function() {
    return response()->json(['api_name' => 'laravel-jwt', 'api_version' => '1.0.0']);
});

route::prefix('v1')->group(function(){
    Route::post('login',[AuthController::class, 'login']);

    Route::middleware([ProtectedRouteAuth::class])->group(function(){
        Route::post('me',[AuthController::class, 'me']);
        Route::post('logout',[AuthController::class, 'logout']);

        //Rotas da rotina de usuário
        Route::get('/users/getAll', [UserController::class, 'getAll']);
        Route::get('/users/getById/{id}', [UserController::class, 'getById']);
        Route::put('/users/update/{id}', [UserController::class, 'update']);
        Route::post('/users/store', [UserController::class, 'store']);
        Route::delete('/users/delete/{id}', [UserController::class, 'destroy']);

    });

});
