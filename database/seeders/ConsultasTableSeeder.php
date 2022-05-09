<?php

namespace Database\Seeders;

use App\Models\Consulta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ConsultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Consulta::create([
            'data' => '2020-02-01',
            'hora' => '15:00',
            'particular' => 'sim',
            'id_paciente' => '2',
            'id_medico' => '3',
        ]);

        Consulta::create([
            'data' => '2020-03-05',
            'hora' => '18:00',
            'particular' => 'nao',
            'id_paciente' => '1',
            'id_medico' => '4',
        ]);

        Consulta::create([
            'data' => '2020-02-01',
            'hora' => '15:00',
            'particular' => 'nao',
            'id_paciente' => '3',
            'id_medico' => '1',
        ]);

    }
}
