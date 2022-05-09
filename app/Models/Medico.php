<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    //Validações de insert
    protected $fillable = [
        'med_nome',
        'med_CRM',
        'id_especialidade'
    ];

    //Método de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['med_nome']))
                $query->orWhere('med_nome', 'like', $data['med_nome']);
        })->paginate($countPage);
    }

    //Método de relacionamento com especialidade
    public function especialidade()
    {
        return $this->hasOne(Especialidade::class,'id','id_especialidade');
    }

}
