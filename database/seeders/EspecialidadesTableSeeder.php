<?php

namespace Database\Seeders;

use App\Models\Especialidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especialidade::create([
            'espec_nome' => 'Obstetra',
        ]);

        Especialidade::create([
            'espec_nome' => 'Ginecologista',
        ]);

        Especialidade::create([
            'espec_nome' => 'Ortopedista',
        ]);

        Especialidade::create([
            'espec_nome' => 'Neurologista',
        ]);

        Especialidade::create([
            'espec_nome' => 'Cardiologista',
        ]);

    }
}
