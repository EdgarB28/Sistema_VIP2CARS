<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{ 
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

     protected $fillable = [
        'nombre',
        'apellidos',
        'nro_documento',
        'correo',
        'telefono',
        'estado',
        'f_creacion'
    ];
}
