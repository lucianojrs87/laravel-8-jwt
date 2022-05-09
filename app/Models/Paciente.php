<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    //Validações de insert
    protected $fillable = [
        'pac_dataNascimento',
        'pac_telefones',
        'pac_nome'
    ];

    //Método de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['pac_nome']))
                $query->orWhere('pac_nome', 'like', $data['pac_nome']);
        })->paginate($countPage);
    }

}
