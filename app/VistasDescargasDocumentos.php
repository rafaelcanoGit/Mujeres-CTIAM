<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VistasDescargasDocumentos extends Model
{
    protected $table='vistas_descargas_documentos';

    protected $primaryKey='id';

    protected $fillable = [
        'id_documento', 'tipo_accion','tipo_archivo'
    ];
    
    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
