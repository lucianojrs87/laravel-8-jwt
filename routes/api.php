<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\Api\v1\ConsultaController;
use App\Http\Controllers\Api\v1\EspecialidadeController;
use App\Http\Controllers\Api\v1\MedicoController;
use App\Http\Controllers\Api\v1\PacienteController;
use App\Http\Controllers\Api\v1\PlanosSaudeController;
use App\Http\Controllers\Api\v1\ProcedimentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\API\v1\ProtectedRouteAuth;
use App\Http\Controllers\Api\v1\UserController;
use App\Models\Medico;

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

        //Rotas da rotina de Pacientes
        Route::get('/pacientes/getAll', [PacienteController::class, 'getAll']);
        Route::get('/pacientes/getById/{id}', [PacienteController::class, 'getById']);
        Route::put('/pacientes/update/{id}', [PacienteController::class, 'update']);
        Route::post('/pacientes/store', [PacienteController::class, 'store']);
        Route::delete('/pacientes/delete/{id}', [PacienteController::class, 'destroy']);

        //Rotas da rotina de Planos de Saúde
        Route::get('/planos_saude/getAll', [PlanosSaudeController::class, 'getAll']);
        Route::get('/planos_saude/getById/{id}', [PlanosSaudeController::class, 'getById']);
        Route::put('/planos_saude/update/{id}', [PlanosSaudeController::class, 'update']);
        Route::post('/planos_saude/store', [PlanosSaudeController::class, 'store']);
        Route::delete('/planos_saude/delete/{id}', [PlanosSaudeController::class, 'destroy']);

        //Rota para associação do Paciente com Plano de saúde
        Route::post('/associacao_pac_plano/associatePatientwithPlan', [PacienteController::class, 'associatePatientwithPlan']);
        Route::delete('/associacao_pac_plano/deleteAssociationPacPlano/{id}', [PacienteController::class, 'deleteAssociationPacPlano']);
        Route::get('/associacao_pac_plano/getAllPlansByIdPatient/{id}', [PacienteController::class, 'getAllPlansByIdPatient']);

        //Rotas da rotina de Especialidades
        Route::get('/especialidades/getAll', [EspecialidadeController::class, 'getAll']);
        Route::get('/especialidades/getById/{id}', [EspecialidadeController::class, 'getById']);
        Route::put('/especialidades/update/{id}', [EspecialidadeController::class, 'update']);
        Route::post('/especialidades/store', [EspecialidadeController::class, 'store']);
        Route::delete('/especialidades/delete/{id}', [EspecialidadeController::class, 'destroy']);

        //Rotas da rotina de Procedimentos
        Route::get('/procedimentos/getAll', [ProcedimentoController::class, 'getAll']);
        Route::get('/procedimentos/getById/{id}', [ProcedimentoController::class, 'getById']);
        Route::put('/procedimentos/update/{id}', [ProcedimentoController::class, 'update']);
        Route::post('/procedimentos/store', [ProcedimentoController::class, 'store']);
        Route::delete('/procedimentos/delete/{id}', [ProcedimentoController::class, 'destroy']);

        //Rotas da rotina de Médicos
        Route::get('/medicos/getAll', [MedicoController::class, 'getAll']);
        Route::get('/medicos/getById/{id}', [MedicoController::class, 'getById']);
        Route::put('/medicos/update/{id}', [MedicoController::class, 'update']);
        Route::post('/medicos/store', [MedicoController::class, 'store']);
        Route::delete('/medicos/delete/{id}', [MedicoController::class, 'destroy']);

        //Rotas da rotina de Consulta
        Route::get('/consultas/getAll', [ConsultaController::class, 'getAll']);
        Route::get('/consultas/getById/{id}', [ConsultaController::class, 'getById']);
        Route::put('/consultas/update/{id}', [ConsultaController::class, 'update']);
        Route::post('/consultas/store', [ConsultaController::class, 'store']);
        Route::delete('/consultas/delete/{id}', [ConsultaController::class, 'destroy']);
        Route::post('/consultas/forwardToProcedure', [ConsultaController::class, 'forwardToProcedure']);
        Route::post('/consultas/getAllProceduresForwarded', [ConsultaController::class, 'getAllProceduresForwarded']);

    });

});
