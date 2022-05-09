<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->date('data')->nullable();
            $table->time('hora')->nullable();
            $table->enum('particular', ['sim', 'nao']);
            //Chave estrangeira com paciente
            $table->unsignedBigInteger('id_paciente')->nullable()->index();
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            //Chave estrangeira com médico
            $table->unsignedBigInteger('id_medico')->nullable()->index();
            $table->foreign('id_medico')->references('id')->on('medicos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
