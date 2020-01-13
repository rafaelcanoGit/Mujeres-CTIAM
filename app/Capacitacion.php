<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    protected $table='capacitacion';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre',
        'descripcion',
        'estado'
    ];

    public function archivos()
    {
        return $this->hasMany(ArchivosCapacitacion::class);
    }
}
