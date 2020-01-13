<?php

namespace App\Http\Controllers;

use App\Capacitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\ArchivosCapacitacion;


class CapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.capacitaciones.index');
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
            "archivos" => "required|array",
            'archivos.*' => 'required|mimes:pdf,pptx,jpg,pub',
            'nombre' => 'required|unique:capacitacion,nombre',
            'descripcion' => 'required'
        );

        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $capacitacion=Capacitacion::create([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            'estado' => $request['estado']
        ]);

        $files=$request->file('archivos');
        $id=$capacitacion->id;
       
        $this->guardarArchivos($files,$id);

        return Response::json($capacitacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Capacitacion  $capacitacion
     * @return \Illuminate\Http\Response
     */
    public function show(Capacitacion $capacitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Capacitacion  $capacitacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capacitacion  = Capacitacion::find($id);
        return Response::json($capacitacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capacitacion  $capacitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'nombre' => 'required',
            'descripcion' => 'required'
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $capacitacion  = Capacitacion::find($id);
        $capacitacionentrante= Capacitacion::where('nombre',$request['nombre'])->first();

        if (empty($capacitacionentrante)||$capacitacionentrante->id==$capacitacion->id) {
            $input = [
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
            ];
        
            $capacitacion->update($input);
            return Response::json($capacitacion);
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe una capacitacion con ese nombre']
                        ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capacitacion  $capacitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capacitacion = Capacitacion::find($id);
        $res=Storage::deleteDirectory('public/archivosCapacitaciones/'.$id);
        $capacitacion->archivos()->delete();
        $capacitacion->delete();
        return Response::json($res);
    }

    protected function guardarArchivos($archivos,$id){

        foreach ($archivos as $archivo) {
           
            $fileName = $archivo->getClientOriginalName();
            $array= explode('.',$fileName);
            $extension=end($array);
            
            $nombre=$id.'-'.$fileName;
            Storage::disk('local')->put('/public/archivosCapacitaciones/'.$id.'/'.$nombre,file_get_contents($archivo));
            $ruta='/public/archivosCapacitaciones/'.$id.'/'.$nombre;
            $rutaPublica='/storage/archivosCapacitaciones/'.$id.'/'.$nombre;

            ArchivosCapacitacion::create([
                'nombre' => $nombre,
                'capacitacion_id' => $id,
                'extension' => $extension,
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ]);
        }
    }
}
