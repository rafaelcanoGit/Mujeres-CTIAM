<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table='documentos';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre',
        'descripcion',
        'estado',
        'extension',
        'ruta',
        'rutaPublica',
        'tipodocumento_id'
    ];

    public function tipodocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }


}
