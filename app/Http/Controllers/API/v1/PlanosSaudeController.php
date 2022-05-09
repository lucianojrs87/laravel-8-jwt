<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\FunctionsSystem;
use App\Http\Lib\MessagesApi;
use App\Models\PlanoSaude;
use Dotenv\Exception\ValidationException;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;

class PlanosSaudeController extends Controller
{
    protected $planosSaude;

    public function __construct(PlanoSaude $planosSaude)
    {
        $this->planosSaude = $planosSaude;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os Planos de Saúde cadastrados na base de dados
    public function getAll()
    {
        $planosSaude = PlanoSaude::all();

        return response()->json($planosSaude, 200);
    }

    public function getById($idPlanoSaude)
    {

        $planoSaude = PlanoSaude::where('id', $idPlanoSaude)->first();
        if ($planoSaude) {
            return response()->json($planoSaude, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function update(Request $request, int $id)
    {
        //
        $planoSaude = $this->planosSaude->find($id);

        if ($planoSaude != null) {

            try {
                $this->checkdata($request);
                $requestData = $request->all();
                $planoSaude->update($requestData);

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

        if ($request->plano_descricao == null) {
            throw new ValidationException();
        }

        if ($request->plano_telefone == null) {
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

            $this->planosSaude->create($requestData);

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

        $planoSaude = $this->planosSaude->find($id);

        if ($planoSaude != null) {
            $delete = $planoSaude->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }
}
