<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incidencia extends Model
{
    use HasFactory;
    //especificamos la tabla que va a controlar
    protected $table = 'incidencias';

    
    // de 1 a muchos, utilizamos la funcion belongsTo para cargar el usuario de la incidencia
    public function usuario()
    {
        return $this->belongsTo('App\Models\User','id_usuario');
    }

    // utilizamos la funcion hasMany para sacar los mensajes de una incidencia
    public function mensajes()
    {
        return $this -> hasMany('App\Models\mensaje');
    }

}
