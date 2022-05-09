<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\MessagesApi;
use App\Models\Procedimento;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ProcedimentoController extends Controller
{
    protected $procedimentos;

    public function __construct(Procedimento $procedimentos)
    {
        $this->procedimentos = $procedimentos;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os users cadastrados na base de dados
    public function getAll()
    {
        $procedimento = Procedimento::all();
        if ($procedimento != null) {
            return response()->json($procedimento, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::LIST_NULL), 404);
        }
    }

    public function getById($idProcedimento)
    {

        $procedimento = Procedimento::where('id', $idProcedimento)->first();
        if ($procedimento) {
            return response()->json($procedimento, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function update(Request $request, int $id)
    {
        //
        $procedimento = $this->procedimentos->find($id);

        if ($procedimento != null) {

            try {
                $this->checkdata($request);
                $requestData = $request->all();
                $procedimento->update($requestData);

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::EDITED_SUCESS), 200);
            } catch (ValidationException $e) {

                return response()->json(array('código' => 400, 'descrição' => $e->getMessage()), 400);
            }
        }
        else{
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function checkdata($request)
    {

        if ($request->proc_nome == null) {
            throw new ValidationException('O nome do procedimento não pode ser nulo');
        }

        if ($request->proc_valor == null) {
            throw new ValidationException('falta informar o valor do procedimento');
        }

        if (!is_numeric($request->proc_valor)) {
            throw new ValidationException('O valor do procedimento está incorreto. Envie no formato correto. Ex: 12.35');
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

            $this->procedimentos->create($requestData);

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

        $procedimento = $this->procedimentos->find($id);

        if ($procedimento != null) {
            $delete = $procedimento->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }
}
