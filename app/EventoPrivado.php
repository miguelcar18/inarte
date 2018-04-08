<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoPrivado extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'eventos_privados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'fecha', 'lugar', 'empresa', 'disciplina'
    ];

    public function nombreDisciplina(){
        return $this->hasOne('App\Disciplina', 'id', 'disciplina');
    }
}
