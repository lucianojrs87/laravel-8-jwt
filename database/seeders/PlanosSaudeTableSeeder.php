<?php

namespace Database\Seeders;

use App\Models\PlanoSaude;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PlanosSaudeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanoSaude::create([
            'plano_descricao' => 'AMIL',
            'plano_telefone' => '8132585412',
        ]);

        PlanoSaude::create([
            'plano_descricao' => 'UNIMED',
            'plano_telefone' => '8134231412',
        ]);

        PlanoSaude::create([
            'plano_descricao' => 'HAPVIDA',
            'plano_telefone' => '8134215874',
        ]);

        PlanoSaude::create([
            'plano_descricao' => 'BRADESCO',
            'plano_telefone' => '813255877',
        ]);

    }
}
