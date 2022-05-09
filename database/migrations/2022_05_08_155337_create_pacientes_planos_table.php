<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesPlanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_planos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paciente')->nullable()->index();
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            //Chave estrangeira com médico
            $table->unsignedBigInteger('id_plano')->nullable()->index();
            $table->foreign('id_plano')->references('id')->on('planos_saude');
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
        Schema::dropIfExists('pacientes_planos');
    }
}
