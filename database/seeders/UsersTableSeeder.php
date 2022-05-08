<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Teste - Avaliador',
            'email' => 'tisaude@teste.com.br',
            'password' => Hash::make('tisaude123'),
        ]);

        User::create([
            'name' => 'Usuário Teste 02',
            'email' => 'user02@teste.com.br',
            'password' => Hash::make('teste02'),
        ]);

        User::create([
            'name' => 'Usuário Teste 03',
            'email' => 'user03@teste.com.br',
            'password' => Hash::make('teste03'),
        ]);

    }
}
