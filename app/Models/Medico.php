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
        'med_especialidade'
    ];

    //Metodo de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['med_nome']))
                $query->orWhere('med_nome', 'like', $data['med_nome']);
        })->paginate($countPage);
    }

}
