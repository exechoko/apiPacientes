<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
	    'apellidos',
	    'edad',
	    'sexo',
	    'dni',
	    'tipo_sangre',
	    'telefono',
	    'correo',
	    'direccion'
    ];

    //Para que no se muestren esos campos cuando usamos el metodo GET
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
