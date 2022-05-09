<?php

namespace App\Http\Lib;

class MessagesApi{

    //Mensagens genéricas
    const CREATED_SUCESS = 'Registro criado com sucesso!';
    const EDITED_SUCESS = 'Registro editado com sucesso!';
    const DELETED_SUCESS = 'Registro deletado com sucesso!';
    const CHECK_FIELDS = 'Verifique os dados enviados na sua requisição!';
    const LIST_NULL = 'Não existe nenhum registro cadastrado!';

    //Mensagens para informar o status da requisição ao usuário
    const STATUS_CODE_200_OK = 'Requisição efetuada com sucesso!';
    const STATUS_CODE_400_BAD_REQUEST = 'Requisição inválida.';
    const STATUS_CODE_404_NOT_FOUND = 'Registro não encontrado! Verifique se informou o Id correto.';
    const STATUS_CODE_502_BAD_GATEWAY = '';
    const STATUS_CODE_401_UNAUTHORIZED = 'Acesso não autorizado. Verifique seus dados e tente novamente.';
    const STATUS_CODE_413_REQUEST_ENTITY_TOO_LARGE = 'A requisição tem um tamanho muito grande.';
    const STATUS_CODE_500_SERVER_ERROR = 'Erro no servidor';
    const STATUS_CODE_503_SERVICE_UNAVAILABLE = 'Serviço indisponível.';
    const STATUS_CODE_504_GATEWAY_TIMEOUT = 'O servidor não recebeu uma resposta em tempo hábil.';

    //Mensagens da rotina de usuários
    const CHECK_FIELD_PASSWORD = 'Informe sua senha.';
    const CHECK_FIELD_EMAIL = 'Informe seu e-mail.';

    //Mensagens da rotina de associação de Paciente ao Plano de saúde
    const PATIENT_NOT_FOUND = 'Paciente não encontrado.';
    const PLAN_NOT_FOUND = 'Plano não encontrado para associação com o paciente.';
    const ASSOCIATION_SUCCESS = 'Associação do paciente ao plano de saúde foi realizada com sucesso.';
    const DUPLICATE_ASSOCIATION = 'Este paciente já está associado a este plano de saúde.';
    const ASSOCIATION_NOT_FOUND = 'Não foi encontrado nenhum número de contrato de Plano de saúde com este valor passado na requisição. Verifique o valor informado e tente novamente.';
    const PATIENT_NOT_FOUND_ASSOCIATION = 'Este paciente não tem nenhum plano de saúde associado';
    //Mensagens da rotina de associação de Médico com Especialidade
    const DOCTOR_NOT_FOUND = 'Médico não encontrado.';
    const SPECIALITY_NOT_FOUND = 'Especialidade não encontrada para associação com o paciente.';
    const DOCTOR_HAS_SPECIALITY = 'Este médico já tem especialdiade associada com o paciente.';
    const SPECIALITY_FIELD_DONT_BE_NULL = 'O campo id_especialidade não pode ser vazio. O médico deverá ter uma especialidade.';

    //Mensagens da rotina de associação de Consulta ao Procedimento
    const MEDICAL_APPOINTMEN_NOT_FOUND = 'Consulta não encontrada para encaminhamento junto ao procedimento.';
    const PROCEDURE_NOT_FOUND = 'Procedimento não encontrado para encaminhamento da consulta.';
    const ASSOCIATION_SUCCESS_MEDICAL_APPOINTMEN = 'A consulta foi encaminhada para a realizacao de um procedimento com sucesso.';
    const DUPLICATE_ASSOCIATION_MEDICAL_APPOINTMEN = 'Este consulta já foi encaminhada para realizacao deste procedimento.';
}
?>
