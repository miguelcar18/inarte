<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'matriculas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 'nombre', 'cedulaRepresentante', 'representante', 'fechaNacimiento', 'disciplina'
    ];

    /**
    * Obtener la cédula, el nombre y el apellido
    *
    * @return string
    */
    public function getCedulaNombreAttribute(){
        if($this->cedula != "" && $this->cedula != null){
            return number_format($this->cedula, 0, '', '.') . ' - ' . $this->nombre;
        }
        else {
            return 'Sin cédula - ' . $this->nombre;
        }
    }

    public function nombreDisciplina(){
        return $this->hasOne('App\Disciplina', 'id', 'disciplina');
    }
}
