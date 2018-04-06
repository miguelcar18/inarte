<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'foto', 'cargo', 'edad', 'nombre', 'cedula', 'fechaIngreso', 'telefono', 'tipo', 'eventos' 
    ];
}
