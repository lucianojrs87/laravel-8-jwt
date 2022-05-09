<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaProcedimento extends Model
{
    protected $table = 'consultas_procedimentos';
    //Validações de insert
    protected $fillable = [
        'id_consulta',
        'id_procedimento',
    ];

    //Método de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['id_consulta']))
                $query->orWhere('id_consulta', 'like', $data['id_consulta']);
            if (isset($data['id_procedimento']))
                $query->orWhere('id_procedimento', 'like', $data['id_procedimento']);
        })->paginate($countPage);
    }

    public function consulta()
    {
        return $this->hasMany(Consulta::class, 'id', 'id_consulta');
    }

    public function procedimento()
    {
        return $this->hasMany(Procedimento::class, 'id', 'id_procedimento');
    }

}
