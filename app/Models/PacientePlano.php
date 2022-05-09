<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacientePlano extends Model
{
    protected $table = 'pacientes_planos';
    //Validações de insert
    protected $fillable = [
        'id_paciente',
        'id_plano',
    ];

    //Método de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['id_paciente']))
                $query->orWhere('id_paciente', 'like', $data['id_paciente']);
            if (isset($data['id_plano']))
                $query->orWhere('id_plano', 'like', $data['id_plano']);
        })->paginate($countPage);
    }

    public function paciente()
    {
        return $this->hasMany(Paciente::class, 'id', 'id_paciente');
    }

    public function plano()
    {
        return $this->hasMany(PlanoSaude::class, 'id', 'id_plano');
    }

}
