<?php

namespace Database\Seeders;

use App\Models\Procedimento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProcedimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Procedimento::create([
            'proc_nome' => 'Raio-X',
            'proc_valor' => '15.30'
        ]);

        Procedimento::create([
            'proc_nome' => 'US',
            'proc_valor' => '100.50'
        ]);

        Procedimento::create([
            'proc_nome' => 'Fisioterapia',
            'proc_valor' => '60.40'
        ]);

        Procedimento::create([
            'proc_nome' => 'Cateterismo',
            'proc_valor' => '1143.30'
        ]);

        Procedimento::create([
            'proc_nome' => 'Consulta Nutricional',
            'proc_valor' => '60.30'
        ]);

    }
}
