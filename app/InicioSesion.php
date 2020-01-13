<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InicioSesion extends Model
{
    protected $table='iniciosesion';

    protected $primaryKey='id';

    protected $fillable = [
        'user', 'tipouser',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
