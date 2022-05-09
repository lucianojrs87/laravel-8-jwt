<?php

namespace Database\Seeders;

use App\Models\ConsultaProcedimento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(PacientesTableSeeder::class);
        $this->call(EspecialidadesTableSeeder::class);
        $this->call(MedicosTableSeeder::class);
        $this->call(ProcedimentosTableSeeder::class);
        $this->call(PlanosSaudeTableSeeder::class);
        $this->call(PacientesPlanosTableSeeder::class);
        $this->call(ConsultasTableSeeder::class);
        $this->call(ConsultaProcedimento::class);
    }
}
