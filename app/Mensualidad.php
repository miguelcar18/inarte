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
        'cedula', 'nombre', 'representante', 'banco', 'comprobante', 'mes'
    ];

    /**
    * Obtener la cédula, el nombre y el apellido
    *
    * @return string
    */
    public function getCedulaNombreAttribute(){
        return number_format($this->cedula, 0, '', '.') . ' - ' . $this->nombre;
    }
}
