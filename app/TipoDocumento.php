<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table='tipodocumento';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
