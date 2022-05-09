<?php

namespace Database\Seeders;

use App\Models\ConsultaProcedimento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ConsultasProcedimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConsultaProcedimento::create([
            'id_consulta' => '1',
            'id_procedimento' => '2',
        ]);

        ConsultaProcedimento::create([
            'id_consulta' => '2',
            'id_procedimento' => '4',
        ]);

    }
}
