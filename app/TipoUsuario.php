<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table='tipousuario';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
