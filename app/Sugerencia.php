<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sugerencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sugerencia', 'nombre'
    ];
}
