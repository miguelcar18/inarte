<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatriculasEvento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'matriculas_eventos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'evento', 'matricula'
    ];

    public function nombreEvento(){
        return $this->hasOne('App\Evento', 'id', 'evento');
    }

    public function nombreMatricula(){
        return $this->hasOne('App\Matricula', 'id', 'matricula');
    }
}
