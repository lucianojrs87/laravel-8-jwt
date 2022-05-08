<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoSaude extends Model
{
    protected $table = 'planos_saude';
    //Validações de insert
    protected $fillable = [
        'plano_descricao',
        'plano_telefone'
    ];

    //Metodo de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['plano_descricao']))
                $query->orWhere('plano_descricao', 'like', $data['plano_descricao']);
        })->paginate($countPage);
    }

}
