<?php

namespace App\Http\Controllers;

use App\AudioVisual;
use App\Documento;
use App\Libro;
use App\Revista;
use App\Slider;
use App\TipoDocumento;
use Illuminate\Http\Request;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UsuarioFinalController extends Controller
{
    public function index(){
        $sliders=Slider::query()->where('estado','visible')->get();
        return view('usuariofinal.inicio.index', compact('sliders'));
    }

    public function multimedia(Request $request){
        
        $nombre=$request->get('nombre');
        $tipo=$request->get('tipo');
        if($nombre==null||$tipo=='video'){
            $documentos=$this->getDocumentos();
        }else{
            $documentos=$this->getDocumentosNombre($nombre);
        }

        $results = $this->paginacion('page1',12,$documentos);

        if($tipo==null){
            $audiovisuales=$this->getVideos();
        }else{
            $audiovisuales=$this->getVideosNombre($nombre);
        }

        $videos=$this->paginacion( 'page2',8,$audiovisuales);

        $tiposdocumentos=TipoDocumento::orderBy('id')->get();

        return view('usuariofinal.multimedia.index', compact('results','videos','tiposdocumentos'));
    }

    public function getDocumentos(){
        return Documento::query()->where('estado','visible')
        ->orderBy('created_at','desc') 
        ->get()->toArray();
    }

    public function getDocumentosNombre($nombre){
        return Documento::query()->where('estado','visible')
        ->where('nombre','LIKE','%'.$nombre.'%')
        ->orderBy('created_at','desc') 
        ->get()->toArray();
    }

    public function getVideos(){
        return AudioVisual::query()->where('estado','visible')
        ->orderBy('created_at','desc')
        ->get()->toArray();
    }

    public function getVideosNombre($nombre){
        return AudioVisual::query()->where('estado','visible')
        ->where('nombre','LIKE','%'.$nombre.'%')
        ->orderBy('created_at','desc')
        ->get()->toArray();
    }

    public function paginacion($pageN,$paginas,$array){
        $page = Input::get($pageN, 1);
        $paginate = $paginas;
    
        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($array, $offSet, $paginate, true);
        return new LengthAwarePaginator($itemsForCurrentPage, count($array), $paginate, $page,
        ['path' => Paginator::resolveCurrentPath(),
        'pageName' => $pageN]);
    }

    public function multimediaTipoDocumento(Request $request,$tipo){
      
        $nombre=$request->get('nombre');
        if($nombre==null){
            $documentos=$this->getDocumentosTipo($tipo);
        }else{
            $documentos=$this->getDocumentosTipoNombre($nombre,$tipo);
        }

        $results = $this->paginacion('page1',12,$documentos);

        $tiposdocumentos=TipoDocumento::orderBy('id')->get();
        $tipoActivo=$tipo;
        return view('usuariofinal.multimedia.index2', compact('results','tiposdocumentos','tipoActivo'));
    } 

    public function getDocumentosTipo($tipo){
        return Documento::query()->where('estado','visible')
        ->where('tipodocumento_id',$tipo)
        ->orderBy('created_at','desc') 
        ->get()->toArray();
    }

    public function getDocumentosTipoNombre($nombre,$tipo){
        return Documento::query()->where('estado','visible')
        ->where('tipodocumento_id',$tipo)
        ->where('nombre','LIKE','%'.$nombre.'%')
        ->orderBy('created_at','desc') 
        ->get()->toArray();
    }

}
