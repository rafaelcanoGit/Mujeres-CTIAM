<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VistasVideos extends Model
{
    protected $table='vistas_videos';

    protected $primaryKey='id';

    protected $fillable = [
        'id_audiovisual', 'tipo_accion','tipo_archivo'
    ];
    
    public function audiovisual()
    {
        return $this->belongsTo(AudioVisual::class);
    }
}
