<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Documento;
use App\Models\Telefone;

class Cliente extends Model
{
    //
    protected $fillable = [
        'nome',
        'image',
    ];


    public function rules()
    {
        return [
            'nome' => 'required',
            'image' => 'image',
        ];
    }

    public function arquivo($id)
    {
        $data = $this->find($id);
        return $data->image;
    }

    // cliente que tem o documento 1 = 1
    public function documento()
    {
        return $this->hasOne(Documento::class, 'cliente_id', 'id');
    }

    // cliente tem 1 para muitos
    public function telefone()
    {
        return $this->hasMany(Telefone::class, 'cliente_id', 'id');
    }    
}
