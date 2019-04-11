<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Megusta extends Model
{
    protected $table = 'megustas';

    public function usuario(){
        return $this->belongsTo('App\User','usuario_id');
    }

    public function imagen(){
        return $this->belongsTo('App\Imagen','imagen_id');
    }
}
