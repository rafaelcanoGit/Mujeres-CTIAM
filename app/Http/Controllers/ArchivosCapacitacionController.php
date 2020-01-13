<?php

namespace App\Http\Controllers;

use App\ArchivosCapacitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Capacitacion;

class ArchivosCapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $capacitacion =Capacitacion::where('id',$id)->first();
        return view('theme.archivosCapacitaciones.index',compact('capacitacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$idc)
    {
        $rules = array(
            "archivos" => "required|array",
            'archivos.*' => 'required|mimes:pdf,pptx,jpg,pub'
        );

        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
    
        $files=$request->file('archivos');    
        //$res= $this->validarNombres($files,$idc);
        if($this->validarNombres($files,$idc)){
            return response()->json(['errors' => 
                        [0 =>'uno de los archivos ya existe']
                        ]);
        }
    
        foreach ($files as $archivo) {
           
            $fileName = $archivo->getClientOriginalName();
            $array= explode('.',$fileName);
            $extension=end($array);
            
            $nombre=$idc.'-'.$fileName;
            Storage::disk('local')->put('/public/archivosCapacitaciones/'.$idc.'/'.$nombre,file_get_contents($archivo));
            $ruta='/public/archivosCapacitaciones/'.$idc.'/'.$nombre;
            $rutaPublica='/storage/archivosCapacitaciones/'.$idc.'/'.$nombre;

            ArchivosCapacitacion::create([
                'nombre' => $nombre,
                'capacitacion_id' => $idc,
                'extension' => $extension,
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ]);
        }

        return Response::json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArchivosCapacitacion  $archivosCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function show(ArchivosCapacitacion $archivosCapacitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArchivosCapacitacion  $archivosCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function edit($idc,$id)
    {
        $archivoCap  = ArchivosCapacitacion::find($id);
        $sinId= explode('-',$archivoCap->nombre,2);
        $sinExt= explode('.',$sinId[1],-1);
        $nombre=implode('.', $sinExt);                 
        $archivoCap=array_add($archivoCap,'nom',$nombre);
        return Response::json($archivoCap);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArchivosCapacitacion  $archivosCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idc,$id)
    {
        $rules = array(
            'nombre' => 'required'
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $archivoC=ArchivosCapacitacion::find($id);
        $nombreNuevo=$idc.'-'.$request['nombre'].'.'.$archivoC->extension;
        $archivoCE=ArchivosCapacitacion::where('nombre',$nombreNuevo)->first();
      
        if (empty($archivoCE)) {
            Storage::move('/public/archivosCapacitaciones/'.$idc.'/'.$archivoC->nombre,
            '/public/archivosCapacitaciones/'.$idc.'/'.$nombreNuevo);
                   
            $ruta='/public/archivosCapacitaciones/'.$idc.'/'.$nombreNuevo;
            $rutaPublica='/storage/archivosCapacitaciones/'.$idc.'/'.$nombreNuevo;

            $input = [
                'nombre' => $nombreNuevo,
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ];
        
            $archivoC->update($input);
            
        }elseif($archivoCE->id==$archivoC->id){
         
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe un archivo con ese nombre']
                        ]);
        }
        
        return Response::json($archivoC);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArchivosCapacitacion  $archivosCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($idc,$id)
    {
        $archivoC = ArchivosCapacitacion::find($id);
        Storage::disk('local')->delete($archivoC->ruta);
        $archivoC->delete();
        return Response::json($archivoC);
    }

    public function descargar($idc,$id)
    {
       $archivoC = ArchivosCapacitacion::find($id);
       return response()->download(storage_path('app'.$archivoC->ruta));
    }

    protected function validarNombres($files,$idc){
        foreach ($files as $archivo) {
            $fileName = $archivo->getClientOriginalName();          
            $nombre=$idc.'-'.$fileName;
            $archivoC=ArchivosCapacitacion::where('nombre',$nombre)->get();
            if($archivoC->isEmpty()){
            }else{
                return true;
            }
        }
        return false;
    }
}
