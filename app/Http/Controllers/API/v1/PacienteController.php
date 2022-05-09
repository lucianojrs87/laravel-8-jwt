<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\FunctionsSystem;
use App\Http\Lib\MessagesApi;
use App\Models\Paciente;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\PlanoSaude;
use App\Models\PacientePlano;

class PacienteController extends Controller
{
    protected $pacientes;
    protected $planosSaude;
    protected $pacientesPlanos;

    public function __construct(Paciente $pacientes, PlanoSaude $planosSaude, PacientePlano $pacientesPlanos)
    {
        $this->pacientes = $pacientes;
        $this->planosSaude = $planosSaude;
        $this->pacientesPlanos = $pacientesPlanos;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os Pacientes cadastrados na base de dados
    public function getAll()
    {
        $paciente = Paciente::all();
        if ($paciente != null) {
            return response()->json($paciente, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::LIST_NULL), 404);
        }
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

        if ($paciente != null) {

            try {

                $this->checkdata($request);
                $requestData = $request->all();
                $paciente->update($requestData);

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

        if ($request->pac_dataNascimento == null) {
            throw new ValidationException('Data de nascimento não pode ser nula');
        }

        if (!FunctionsSystem::validateDate($request->pac_dataNascimento)) {
            throw new ValidationException('Data de nascimento não é válida. Envie no formato: Y-m-d. Ex: 2021-01-01');
        }

        if ($request->pac_telefones == null) {
            throw new ValidationException('Telefone não pode ser nulo');
        }

        if ($request->pac_nome == null) {
            throw new ValidationException('O nome do paciente não pode ser nulo');
        }
    }

    //Método que faz a associação do Paciente com o Plano de saúde
    public function associatePatientwithPlan(Request $request)
    {
        $requestData = $request->all();
        $paciente = $this->pacientes->find($requestData['id_paciente']);
        $planoSaude = $this->planosSaude->find($requestData['id_plano']);
        if ($paciente == null) {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::PATIENT_NOT_FOUND), 404);
        }
        if ($planoSaude == null) {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::PLAN_NOT_FOUND), 404);
        }
        if ($paciente != null && $planoSaude != null) {
            $associacao = $this->pacientesPlanos->where('id_paciente', $requestData['id_paciente'])
                ->where('id_plano', $requestData['id_plano'])->first();
            if ($associacao == null) {
                $pacientePlano = $this->pacientesPlanos->create($requestData);

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::ASSOCIATION_SUCCESS), 200);
            } else {
                return response()->json(array('código' => 400, 'descrição' => MessagesApi::DUPLICATE_ASSOCIATION), 400);
            }
        }
    }

    public function getAllPlansByIdPatient($idPaciente)
    {
        $planosAssociados = $this->pacientesPlanos->where('id_paciente', $idPaciente)->get();

        if ($planosAssociados != null) {

            foreach ($planosAssociados as $item) {
                $item['plano'] = $item->plano()->first()->plano_descricao;
                $item['paciente'] = $item->paciente()->first()->pac_nome;
            }

            return response()->json($planosAssociados, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::PATIENT_NOT_FOUND_ASSOCIATION), 404);
        }
    }


    public function deleteAssociationPacPlano($idAssociacao)
    {
        $associacao = $this->pacientesPlanos->find($idAssociacao);

        if ($associacao != null) {
            $delete = $associacao->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::ASSOCIATION_NOT_FOUND), 400);
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
