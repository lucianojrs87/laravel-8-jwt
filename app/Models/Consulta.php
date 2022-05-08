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
        'particular'
    ];

    //Metodo de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['data']))
                $query->orWhere('data', 'like', $data['data']);
        })->paginate($countPage);
    }

    public function comboModelos()
    {
        $modelos = $this->all();

        $arrModelos = array();
        $arrModelos[''] = 'Selecione...';
        foreach ($modelos as $key => $item) {
            $arrModelos[$item->id] = $item->nome;
        }
        return $arrModelos;
    }
}
