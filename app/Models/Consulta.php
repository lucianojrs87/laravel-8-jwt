<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';
    //Validações de insert
    protected $fillable = [
        'data',
        'hora',
        'id_paciente',
        'id_medico',
        'particular'
    ];

    //Método de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['data']))
                $query->orWhere('data', 'like', $data['data']);
        })->paginate($countPage);
    }

    //Método de relacionamento com Paciente
    public function paciente()
    {
        return $this->hasOne(Paciente::class,'id','id_paciente');
    }

    //Método de relacionamento com Médico
    public function medico()
    {
        return $this->hasOne(Medico::class,'id','id_medico');
    }

}
