<?php

use Illuminate\Support\Facades\Route;
use App\AudioVisual;
use App\Capacitacion;
use App\Documento;
use App\Libro;
use App\Revista;
use App\Slider;
use App\TipoDocumento;
use App\TipoUsuario;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('users', function () {
    return datatables()
        ->eloquent(User::query()->where('is_admin','0'))
        ->addColumn('tipousuario', function($data){
            $tiposusuarios = TipoUsuario::orderBy('id')->get();
            $tipoU='';
            foreach($tiposusuarios as $tipo){
                if ($tipo->id==$data->tipousuario_id) {
                    $tipoU=$tipo->nombre;
                }
            }
            return $tipoU;
        })
        ->addColumn('btns','theme.usuarios.btnsIndex')
        ->rawColumns(['btns'])
        ->toJson();
});

Route::get('documentos', function () {
    return datatables()
        ->eloquent(Documento::query())
        ->addColumn('tipodocumento', function($data){
            $tiposdocumentos = TipoDocumento::orderBy('id')->get();
            $tipoD='';
            foreach($tiposdocumentos as $tipo){
                if ($tipo->id==$data->tipodocumento_id) {
                    $tipoD=$tipo->nombre;
                }
            }
            return $tipoD;
        })
        ->addColumn('descargar','theme.documentos.btnsDescargar')
        ->addColumn('btns','theme.documentos.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
});

Route::get('audiovisuales', function () {
    return datatables()
        ->eloquent(AudioVisual::query())
        ->addColumn('descargar','theme.audiovisuales.btnsDescargar')
        ->addColumn('btns','theme.audiovisuales.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
});

Route::get('capacitaciones', function () {
    return datatables()
        ->eloquent(Capacitacion::query())
        ->addColumn('verArchivos','theme.capacitaciones.btnsVerArchivos')
        ->addColumn('btns','theme.capacitaciones.btnsIndex')
        ->rawColumns(['btns','verArchivos'])
        ->toJson();
});

Route::get('archivosCapacitacion/{id}', function () {
    $id= $_GET['id'];
    return datatables()
        ->eloquent(Capacitacion::find($id)->archivos())
        ->addColumn('descargar','theme.archivosCapacitaciones.btnsDescargar')
        ->addColumn('btns','theme.archivosCapacitaciones.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
})->name('listar_archivosCapacitacion');

Route::get('sliders', function () {
    return datatables()
        ->eloquent(Slider::query())
        ->addColumn('img','theme.sliders.img')
        ->addColumn('btns','theme.sliders.btnsIndex')
        ->rawColumns(['btns','img'])
        ->toJson();
});