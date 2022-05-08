<?php

namespace App\Http\Lib;

class MessagesApi{

    //Mensagens genéricas
    const CREATED_SUCESS = 'Registro criado com sucesso!';
    const EDITED_SUCESS = 'Registro editado com sucesso!';
    const DELETED_SUCESS = 'Registro deletado com sucesso!';
    const CHECK_FIELDS = 'Verifique os dados enviados na sua requisição!';

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
}
?>
