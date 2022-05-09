<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $table = 'procedimentos';
    //Validações de insert
    protected $fillable = [
        'proc_nome',
        'proc_valor'
    ];

    //Método de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['proc_nome']))
                $query->orWhere('proc_nome', 'like', $data['proc_nome']);
        })->paginate($countPage);
    }

}
