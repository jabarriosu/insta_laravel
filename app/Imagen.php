<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';


    //Relación de uno a muchos.
    public function comentarios(){
        return $this->hasMany('App\Comentario')->orderBy('id','desc');
    }

    //Relación de uno a muchos.
    public function megustas(){
        return $this->hasMany('App\Megusta');
    }

    //Relación de muchos a uno.
    public function usuario(){
        return $this->belongsTo('App\User','usuario_id');
    }
}
