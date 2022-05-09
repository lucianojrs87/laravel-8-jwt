<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PacientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paciente::create([
            'pac_dataNascimento' => '2022-03-04',
            'pac_telefones' => 'paciente01@teste.com.br',
            'pac_nome' => 'Paciente para testes 01'
        ]);

        Paciente::create([
            'pac_dataNascimento' => '2022-09-08',
            'pac_telefones' => 'paciente02@teste.com.br',
            'pac_nome' => 'Paciente para testes 02'
        ]);

        Paciente::create([
            'pac_dataNascimento' => '2022-07-02',
            'pac_telefones' => 'paciente03@teste.com.br',
            'pac_nome' => 'Paciente para testes 03'
        ]);

    }
}
