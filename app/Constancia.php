<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constancia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'constancias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dirigido', 'nombre', 'cedula', 'tiempo', 'telefono', 'tipo'
    ];
}
