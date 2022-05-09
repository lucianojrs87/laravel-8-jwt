<?php

namespace Database\Seeders;

use App\Models\PacientePlano;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PacientesPlanosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PacientePlano::create([
            'id_paciente' => '1',
            'id_plano' => '2',
        ]);

        PacientePlano::create([
            'id_paciente' => '3',
            'id_plano' => '1',
        ]);

    }
}
