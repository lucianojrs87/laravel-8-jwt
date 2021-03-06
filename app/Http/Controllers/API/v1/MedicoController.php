<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\MessagesApi;
use App\Models\Medico;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\Especialidade;

class MedicoController extends Controller
{
    protected $medicos;
    protected $especialidades;


    public function __construct(Medico $medicos, Especialidade $especialidades)
    {
        $this->medicos = $medicos;
        $this->especialidades = $especialidades;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os users cadastrados na base de dados
    public function getAll()
    {
        $medico = Medico::all();
        if ($medico != null) {
            foreach ($medico as $item) {
                $item['especialidade'] = $item->especialidade()->first()->espec_nome;
            }

            return response()->json($medico, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::LIST_NULL), 404);
        }
    }

    public function getById($idMedico)
    {

        $medico = Medico::where('id', $idMedico)->first();
        if ($medico) {
            $medico['especialidade'] = $medico->especialidade()->first()->espec_nome;
            return response()->json($medico, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function update(Request $request, int $id)
    {
        //
        $medico = $this->medicos->find($id);

        if ($medico != null) {
            try {
                $this->checkdata($request);
                $requestData = $request->all();
                $medico->update($requestData);

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::EDITED_SUCESS), 200);
            } catch (ValidationException $e) {

                return response()->json(array('código' => 400, 'descrição' => $e->getMessage()), 400);
            }
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function checkdata($request)
    {

        if ($request->med_nome == null) {
            throw new ValidationException();
        }

        if ($request->med_CRM == null) {
            throw new ValidationException();
        }

        if ($request->id_especialidade == null) {
            throw new ValidationException(MessagesApi::SPECIALITY_FIELD_DONT_BE_NULL);
        }

        if ($request->id_especialidade != null && $this->especialidades->find($request->id_especialidade) == null) {
            throw new ValidationException(MessagesApi::SPECIALITY_NOT_FOUND);
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

            $this->medicos->create($requestData);

            return response()->json(array('código' => 200, 'descrição' => MessagesApi::CREATED_SUCESS), 200);
        } catch (ValidationException $e) {

            return response()->json(array('código' => 400, 'descrição' => $e->getMessage()), 400);
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

        $medico = $this->medicos->find($id);

        if ($medico != null) {
            $delete = $medico->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }
}
