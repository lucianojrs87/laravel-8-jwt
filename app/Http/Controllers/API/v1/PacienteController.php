<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\FunctionsSystem;
use App\Http\Lib\MessagesApi;
use App\Models\Paciente;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Exception;

class PacienteController extends Controller
{
    protected $pacientes;

    public function __construct(Paciente $pacientes)
    {
        $this->pacientes = $pacientes;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os Pacientes cadastrados na base de dados
    public function getAll()
    {
        $paciente = Paciente::all();

        return response()->json($paciente, 200);
    }

    public function getById($idPaciente)
    {

        $paciente = Paciente::where('id', $idPaciente)->first();
        if ($paciente) {
            return response()->json($paciente, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function update(Request $request, int $id)
    {
        //
        $paciente = $this->pacientes->find($id);


        try {

            $this->checkdata($request);
            $requestData = $request->all();
            $paciente->update($requestData);

            return response()->json(array('código' => 200, 'descrição' => MessagesApi::EDITED_SUCESS), 200);
        } catch (ValidationException $e) {


            return response()->json(array('código' => 400, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }

    public function checkdata($request)
    {

        if ($request->pac_dataNascimento == null) {
            throw new ValidationException();
        }

        if (!FunctionsSystem::validateDate($request->pac_dataNascimento)) {
            throw new ValidationException();
        }

        if ($request->pac_telefones == null) {
            throw new ValidationException();
        }

        if ($request->pac_nome == null) {
            throw new ValidationException();
        }
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->checkdata($request);
            $requestData = $request->all();

            $this->pacientes->create($requestData);

            return response()->json(array('código' => 200, 'descrição' => MessagesApi::CREATED_SUCESS), 200);
        } catch (ValidationException $e) {

            return response()->json(array('código' => 400, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $paciente = $this->pacientes->find($id);

        if ($paciente != null) {
            $delete = $paciente->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }
}
