<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Lib\FunctionsSystem;
use App\Http\Lib\MessagesApi;
use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\ConsultaProcedimento;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\Procedimento;
use App\Models\PacientePlano;

class ConsultaController extends Controller
{
    protected $consultas;
    protected $pacientes;
    protected $medicos;
    protected $procedimentos;
    protected $consultaProcedimentos;
    protected $pacientesPlanos;

    public function __construct(
        Consulta $consultas,
        Paciente $pacientes,
        Medico $medicos,
        ConsultaProcedimento $consultaProcedimentos,
        Procedimento $procedimentos,
        PacientePlano $pacientesPlanos
    ) {
        $this->consultas = $consultas;
        $this->pacientes = $pacientes;
        $this->medicos = $medicos;
        $this->consultaProcedimentos = $consultaProcedimentos;
        $this->procedimentos = $procedimentos;
        $this->pacientesPlanos = $pacientesPlanos;
    }

    public function index()
    {
    }

    //Método que irá retornar todos os users cadastrados na base de dados
    public function getAll()
    {
        $consulta = Consulta::all();

        if (count($consulta) > 0) {
            foreach ($consulta as $item) {
                $item['paciente'] = $item->paciente()->first()->pac_nome;
                $item['medico'] = $item->medico()->first()->med_nome;
            }
            return response()->json($consulta, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::LIST_NULL), 404);
        }
    }

    public function getById($idConsulta)
    {
        $consulta = Consulta::where('id', $idConsulta)->first();
        if ($consulta != null) {
            $consulta['paciente'] = $consulta->paciente()->first()->pac_nome;
            $consulta['medico'] = $consulta->medico()->first()->med_nome;

            return response()->json($consulta, 200);
        } else {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_404_NOT_FOUND), 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $consulta = $this->consultas->find($id);

        if ($consulta != null) {

            try {

                $this->checkdata($request);
                $requestData = $request->all();
                $consulta->update($requestData);

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

        if ($request->data == null) {
            throw new ValidationException('Informe a data para realização da consulta.');
        }

        if (!FunctionsSystem::validateDate($request->data)) {
            throw new ValidationException('Data não é válida. Envie no formato: Y-m-d. Ex: 2021-01-01');
        }

        if ($request->hora == null) {
            throw new ValidationException('Informe a hora para realização da consulta.');
        }

        if (!FunctionsSystem::validate_hour($request->hora)) {
            throw new ValidationException('Hora não é válida. Envie no formato: HORA-MINUTO. Ex: 18:00');
        }


        if ($request->id_paciente == null) {
            throw new ValidationException('Informe o paciente que vai ser consultado.');
        }

        if ($request->id_medico == null) {
            throw new ValidationException('Informe o médico que vai realizar a consulta');
        }

        if (!is_numeric($request->id_medico)) {
            throw new ValidationException('O campo do médico deve ser um número.');
        }

        if (!is_numeric($request->id_paciente)) {
            throw new ValidationException('O campo do paciente deve ser um número.');
        }

        if ($request->id_medico != null && $this->medicos->find($request->id_medico) == null) {
            throw new ValidationException(MessagesApi::DOCTOR_NOT_FOUND);
        }

        if ($request->id_paciente != null && $this->pacientes->find($request->id_paciente) == null) {
            throw new ValidationException(MessagesApi::PATIENT_NOT_FOUND);
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

            //Verifica se o paciente tem plano de saude, caso nao tenha a consulta será particular.
            $pacientePlano = $this->pacientesPlanos->where('id_paciente', $requestData['id_paciente'])->get();
            if(count($pacientePlano) > 0) {
                $requestData['particular'] = "nao";
            }
            else{
                $requestData['particular'] = "sim";
            }

            $this->consultas->create($requestData);

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

        $consulta = $this->consultas->find($id);

        if ($consulta != null) {
            $delete = $consulta->delete();

            if ($delete) {

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::DELETED_SUCESS), 200);
            }
        } else {

            return response()->json(array('código' => 404, 'descrição' => MessagesApi::STATUS_CODE_400_BAD_REQUEST), 400);
        }
    }

    //Funcao responsavel para caso o medico nao queira finalizar a consulta,
    //mas sim encaminhar o paciente para realizar um procedimento.
    public function forwardToProcedure(Request $request)
    {
        $requestData = $request->all();
        $consulta = $this->consultas->find($requestData['id_consulta']);
        $procedimento = $this->procedimentos->find($requestData['id_procedimento']);
        if ($consulta == null) {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::MEDICAL_APPOINTMEN_NOT_FOUND), 404);
        }
        if ($procedimento == null) {
            return response()->json(array('código' => 404, 'descrição' => MessagesApi::PROCEDURE_NOT_FOUND), 404);
        }
        if ($consulta != null && $procedimento != null) {
            $associacao = $this->consultaProcedimentos->where('id_consulta', $requestData['id_consulta'])
                ->where('id_procedimento', $requestData['id_procedimento'])->first();
            if ($associacao == null) {
                $consultaProcedimento = $this->consultaProcedimentos->create($requestData);

                return response()->json(array('código' => 200, 'descrição' => MessagesApi::ASSOCIATION_SUCCESS_MEDICAL_APPOINTMEN), 200);
            } else {
                return response()->json(array('código' => 400, 'descrição' => MessagesApi::DUPLICATE_ASSOCIATION_MEDICAL_APPOINTMEN), 400);
            }
        }
    }
}
