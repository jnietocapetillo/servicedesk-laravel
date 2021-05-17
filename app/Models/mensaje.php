<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';

    // relacion muchos a 1
    public function usuarios()
    {
        return $this->belongsTo('App\Models\User','id_usuario');
    }

    public function incidencias()
    {
        return $this->belongsTo('App\Models\incidencia','id_incidencia');
    }
}
