

## API - Laravel com JWT

Api criada em Laravel na versão 8 com MySql e implementando JWT como autenticador.

- Laravel Framework 8.83.11
- PHP 7.3.19

## 1) Configuração do banco de dados

Configurei com estes dados:

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3307
- DB_DATABASE=api-tisaude
- DB_USERNAME=root
- DB_PASSWORD=root

Ao clonar o projeto no git irá um arquivo .env-example. Todas as informações de conexão estarão lá, basta se atentar para a porta, o nome do DB, o username e a senha de acesso ao banco no ambiente que o avaliador irá testar para que possa espelhar corretamente. Copie o arquivo, cole e em seguida terá de renomeá-lo desta forma: ".env"
 
Se seu acesso no banco não tiver senha (Geralmente no ambiente local é comum não ter senha ou ter senha "root"), edite o arquivo .env não setando valor em DB_PASSWORD=

## 2) Atualize nossos pacotes de projeto 
Rode o comando:

```bash
Composer update
```

## 3) Gerar a key do nosso projeto

Em seguida iremos gerar a key do nosso projeto com o comando:

```bash
php artisan key:generate
```

## 4) Gerar a key de autenticação do JWT

Rode o comando:

```bash
php artisan jwt:secret
```


## 5) Alimentando os dados em nosso banco

Resolvi utilizar migrations para criar as tabelas do banco de dados e seeders para inserir registros.
Rode o comando: 

```bash
php artisan migrate:fresh --seed
```

O banco ja virá todo alimentado por meio das sementes que executamos no quinto passo, que consequentemente irá gerar comodidade de quem for executar o projeto, todavia os endpoints estarão aí para uso livre da API.
Irá ser criado o registro de acesso no banco de dados do qual o avaliador terá acesso e que o guiará na autenticação com o JWT nas demais rotinas da API.

Segue abaixo as credenciais de acesso:

```bash
E-mail: tisaude@teste.com.br
Password: tisaude123
```
Seguem os endpoints:

## Login

- http://localhost/laravel-8-jwt/public/api/login - Única rota aberta. Por meio dela iremos informar nossas credenciais de acesso (E-mail e password), ao acessá-la corretamente, um token será gerado. Por meio dele iremos percorrer as outras rotas.
- http://localhost/laravel-8-jwt/public/api/me - Rota que irá mostrar nossos dados de usuário.
- http://localhost/laravel-8-jwt/public/api/logout - Ao acessá-la, o usuário será deslogado e terá seu token finalizado, sendo assim ficará impedido de trafegar pelos outros endpoints.

## Usuários

- http://localhost/laravel-8-jwt/public/api/v1/users/getAll - Irá retornar todos os usuários cadastrados em nossa base de dados. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/users/getById/{id} - Irá retornar o usuário cadastrado em nossa base de dados mediante ao valor do Id passado pela url. Verbo: GET 
- http://localhost/laravel-8-jwt/public/api/v1/users/update/{id} - Método que fará o update do usuário. Verbo: PUT
- http://localhost/laravel-8-jwt/public/api/v1/users/store - Método que irá criar um novo usuário. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/users/delete/{id} - Irá deletar o usuário mediante ao valor do Id passado pela url. Verbo: DELETE

## Pacientes
- http://localhost/laravel-8-jwt/public/api/v1/pacientes/getAll - Irá retornar todos os pacientes cadastrados em nossa base de dados. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/pacientes/getById/{id} - Irá retornar o paciente cadastrado em nossa base de dados mediante ao valor do Id passado pela url. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/pacientes/update/{id} - Método que fará o update do paciente. Verbo: PUT
- http://localhost/laravel-8-jwt/public/api/v1/pacientes/store - Método que irá criar um novo paciente. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/pacientes/delete/{id} - Irá deletar o paciente mediante ao valor do Id passado pela url. Verbo: DELETE

## Planos de Saúde
- http://localhost/laravel-8-jwt/public/api/v1/planos_saude/getAll - Irá retornar todos os planos de saúde cadastrados em nossa base de dados. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/planos_saude/getById/{id} - Irá retornar o plano de saúde cadastrado em nossa base de dados mediante ao valor do Id passado pela url. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/planos_saude/update/{id} - Método que fará o update do plano de saúde. Verbo: PUT
- http://localhost/laravel-8-jwt/public/api/v1/planos_saude/store - Método que irá criar um novo plano de saúde. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/planos_saude/delete/{id} - Irá deletar o planos de saúde mediante ao valor do Id passado pela url. Verbo: DELETE

## Associação do Paciente com Planos de Saúde
- http://localhost/laravel-8-jwt/public/api/v1/associacao_pac_plano/associatePatientwithPlan - Método que faz a associação do Paciente com o Plano de saúde. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/associacao_pac_plano/deleteAssociationPacPlano/{id} - Irá deletar a associação mediante ao Id da associação passado pela url. Verbo: DELETE.
- http://localhost/laravel-8-jwt/public/api/v1/associacao_pac_plano/getAllPlansByIdPatient/{id} - Irá trazer todos os planos de saúde associados ao paciente mediante ao Id do paciente passado pela url. Verbo: GET.

## Especialidades
- http://localhost/laravel-8-jwt/public/api/v1/especialidades/getAll - Irá retornar todos as especialidades cadastrados em nossa base de dados. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/especialidades/getById/{id} - Irá retornar a especialidade cadastrada em nossa base de dados mediante ao valor do Id passado pela url. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/especialidades/update/{id} - Método que fará o update da especialidade. Verbo: PUT
- http://localhost/laravel-8-jwt/public/api/v1/especialidades/store - Método que irá criar uma nova especialidade. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/especialidades/delete/{id} - Irá deletar a especialidade mediante ao valor do Id passado pela url. Verbo: DELETE

## Procedimentos
- http://localhost/laravel-8-jwt/public/api/v1/procedimentos/getAll - Irá retornar todos os procedimentos cadastrados em nossa base de dados. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/procedimentos/getById/{id} - Irá retornar o procedimento cadastrado em nossa base de dados mediante ao valor do Id passado pela url. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/procedimentos/update/{id} - Método que fará o update do procedimento. Verbo: PUT
- http://localhost/laravel-8-jwt/public/api/v1/procedimentos/store - Método que irá criar um novo procedimento. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/procedimentos/delete/{id} - Irá deletar o procedimento mediante ao valor do Id passado pela url. Verbo: DELETE

## Médicos
- http://localhost/laravel-8-jwt/public/api/v1/medicos/getAll - Irá retornar todos os médicos cadastrados em nossa base de dados. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/medicos/getById/{id} - Irá retornar o médico cadastrado em nossa base de dados mediante ao valor do Id passado pela url. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/medicos/update/{id} - Método que fará o update do médico. Verbo: PUT
- http://localhost/laravel-8-jwt/public/api/v1/medicos/store - Método que irá criar um novo médico. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/medicos/delete/{id} - Irá deletar o médico mediante ao valor do Id passado pela url. Verbo: DELETE
 
 ## Consultas
- http://localhost/laravel-8-jwt/public/api/v1/consultas/getAll - Irá retornar todos as consultas cadastrados em nossa base de dados. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/consultas/getById/{id} - Irá retornar a consulta cadastrada em nossa base de dados mediante ao valor do Id passado pela url. Verbo: GET
- http://localhost/laravel-8-jwt/public/api/v1/consultas/update/{id} - Método que fará o update da consulta. Verbo: PUT
- http://localhost/laravel-8-jwt/public/api/v1/consultas/store - Método que irá criar uma nova consulta. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/consultas/delete/{id} - Irá deletar a consulta mediante ao valor do Id passado pela url. Verbo: DELETE
- http://localhost/laravel-8-jwt/public/api/v1/consultas/forwardToProcedure - Função responsável para caso o médico não queira finalizar a consulta, mas sim encaminhar o paciente para realizar um procedimento. Verbo: POST
- http://localhost/laravel-8-jwt/public/api/v1/consultas/getAllProceduresForwarded - Função que retorna todos os dados das consultas que foram encaminhadas para realizar um procedimento adicional. Verbo: POST





