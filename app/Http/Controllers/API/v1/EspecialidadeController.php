<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\MessagesApi;
use App\Models\Especialidade;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    protected $especialidades;

    public function __construct(Especialidade $especialidades)
    {
        $this->especialidades = $especialidades;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os users cadastrados na base de dados
    public function getAll()
    {
        $especialidade = Especialidade::all();

        return response()->json($especialidade, 200);
    }

    public function getById($idEspecialidade)
    {

        $especialidade = Especialidade::where('id', $idEspecialidade)->first();
        if ($especialidade) {
            return response()->json($especialidade, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function update(Request $request, int $id)
    {
        //
        $especialidade = $this->especialidades->find($id);


        try {

            $this->checkdata($request);
            $requestData = $request->all();
            $especialidade->update($requestData);

            return response()->json(array('código' => 200, 'descrição' => MessagesApi::EDITED_SUCESS), 200);
        } catch (ValidationException $e) {


            return response()->json(array('código' => 400, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }

    public function checkdata($request)
    {

        if ($request->espec_nome == null) {
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

            $this->especialidades->create($requestData);

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

        $especialidade = $this->especialidades->find($id);

        if ($especialidade != null) {
            $delete = $especialidade->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }
}
