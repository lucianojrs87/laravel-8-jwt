<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasProcedimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas_procedimentos', function (Blueprint $table) {
            $table->id();
            //Chave estrangeira com consulta
            $table->unsignedBigInteger('id_consulta')->nullable()->index();
            $table->foreign('id_consulta')->references('id')->on('consultas');
            //Chave estrangeira com procedimento
            $table->unsignedBigInteger('id_procedimento')->nullable()->index();
            $table->foreign('id_procedimento')->references('id')->on('procedimentos');
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
        Schema::dropIfExists('consultas_procedimentos');
    }
}
