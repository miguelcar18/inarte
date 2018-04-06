<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mensualidades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banco', 'comprobante', 'mes', 'anio', 'matricula'
    ];

    public function nombreMatricula(){
        return $this->hasOne('App\Matricula', 'id', 'matricula');
    }
}
