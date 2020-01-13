<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioVisual extends Model
{
    protected $table= 'audiovisual';

    protected $primaryKey='id';

    protected $fillable= [
        'nombre',
        'descripcion',
        'estado',
        'extension',
        'ruta',
        'rutaPublica',
        'tipo',
        'link'
    ];
}
