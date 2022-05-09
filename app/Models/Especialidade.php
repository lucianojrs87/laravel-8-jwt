<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $table = 'especialidades';
    //Validações de insert
    protected $fillable = [
        'espec_nome',
    ];

    //Método de busca
    public function search(array $data, $countPage)
    {
        # code...
        return $this->where(function ($query) use ($data) {
            if (isset($data['espec_nome']))
                $query->orWhere('espec_nome', 'like', $data['espec_nome']);
        })->paginate($countPage);
    }

}
