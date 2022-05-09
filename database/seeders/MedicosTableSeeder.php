<?php

namespace Database\Seeders;

use App\Models\Medico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MedicosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medico::create([
            'med_nome' => 'Médico Teste 01',
            'med_CRM' => '157812',
            'id_especialidade' => '2',
        ]);

        Medico::create([
            'med_nome' => 'Médico Teste 02',
            'med_CRM' => '157442',
            'id_especialidade' => '1',
        ]);

        Medico::create([
            'med_nome' => 'Médico Teste 03',
            'med_CRM' => '157858',
            'id_especialidade' => '3',
        ]);

        Medico::create([
            'med_nome' => 'Médico Teste 04',
            'med_CRM' => '154122',
            'id_especialidade' => '5',
        ]);

        Medico::create([
            'med_nome' => 'Médico Teste 05',
            'med_CRM' => '157878',
            'id_especialidade' => '4',
        ]);

    }
}
