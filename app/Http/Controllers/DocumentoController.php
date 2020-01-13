<?php

namespace App\Http\Controllers;

use App\Documento;
use App\TipoDocumento;
use App\VistasDescargasDocumentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;


class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tiposdocumentos = TipoDocumento::orderBy('id')->get();
        return view('theme.documentos.index',compact('tiposdocumentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'documento' => 'required|mimes:pdf',
            'descripcion' => 'required'
        );

        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        //obtenemos el campo file definido en el formulario
        $file = $request->file('documento');
        //obtenemos el nombre del archivo
        $fileName = $file->getClientOriginalName();
    
        $documentoentrante= Documento::where('nombre',$fileName)->first();
    
        if (empty($documentoentrante)) {
            $array= explode('.',$fileName);
        
            $extension=end($array);

            Storage::disk('local')->put('/public/documentos/'.$fileName,file_get_contents($file));
            $ruta='/public/documentos/'.$fileName;
            $rutaPublica='storage/documentos/'.$fileName;

            $documento=  Documento::create([
                'nombre' => $fileName,
                'descripcion' => $request['descripcion'],
                'tipodocumento_id' => $request['tipodocumento'],
                'estado' => $request['estado'],
                'extension' => $extension,
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ]);
        }else{
            return response()->json(['errors' => 
                        [0 =>'El documento ya existe']
                        ]);
        }   
        return Response::json($documento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documento  = Documento::find($id);
        $noms= explode('.',$documento->nombre,-1);
        $nombre=implode('.', $noms);         
        $documento=array_add($documento,'nomsinext',$nombre);
        return Response::json($documento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules = array(
            'nombre' => 'required',
            'descripcion' => 'required'
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $documento  = Documento::find($id);
        $nombreNuevo=$request['nombre'].'.'.$documento->extension;
        $documentoentrante= Documento::where('nombre',$nombreNuevo)->first();

        if (empty($documentoentrante)) {

            Storage::move('/public/documentos/'.$documento->nombre,
            '/public/documentos/'.$nombreNuevo);
                   
            $ruta='/public/documentos/'.$nombreNuevo;
            $rutaPublica='/storage/documentos/'.$nombreNuevo;

            $input = [
                'nombre' => $nombreNuevo,
                'descripcion' => $request['descripcion'],
                'tipodocumento_id' => $request['tipodocumento'],
                'estado' => $request['estado'],
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ];
        
            $documento->update($input);
        }elseif($documentoentrante->id==$documento->id){

            $input = [
                'descripcion' => $request['descripcion'],
                'tipodocumento_id' => $request['tipodocumento'],
                'estado' => $request['estado']
            ];
        
            $documento->update($input);
            
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe un documento con ese nombre']
                        ]);
        }

        return Response::json($documento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = Documento::find($id);
        Storage::disk('local')->delete($documento->ruta);
        $documento->delete();
        return Response::json($documento);
    }

    public function descargar($id)
    {
        $documento = Documento::find($id);
        $user=Auth::user();
        if ($user->is_admin==0) {
            VistasDescargasDocumentos::create([
                'id_documento'=>$documento->id,
                'tipo_accion'=>'descarga',
                'tipo_archivo'=>$documento->tipodocumento->nombre
            ]);
        }
        return response()->download(storage_path("app".$documento->ruta));
    }

    public function ver($id)
    {
        $documento = Documento::find($id);
        $user=Auth::user();
        if ($user->is_admin==0) {
            VistasDescargasDocumentos::create([
                'id_documento'=>$documento->id,
                'tipo_accion'=>'visita',
                'tipo_archivo'=>$documento->tipodocumento->nombre
            ]);
        }
    }
    public function ver2($tipo,$id)
    {
        $documento = Documento::find($id);
        $user=Auth::user();
        if ($user->is_admin==0) {
            VistasDescargasDocumentos::create([
                'id_documento'=>$documento->id,
                'tipo_accion'=>'visita',
                'tipo_archivo'=>$documento->tipodocumento->nombre
            ]);
        }
    }
    
}
