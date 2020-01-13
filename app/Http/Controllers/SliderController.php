<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.sliders.index');
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
    public function store(Request $request)
    {
        $rules = array(
            'nombre' => 'required|unique:sliders,nombre',
            'link' => 'required',
            'imagen' => 'required|mimes:jpeg|dimensions:max_width=2406,max_height=1038'
        );

        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file = $request->file('imagen');
        $fileName = $file->getClientOriginalName();

        Storage::disk('local')->put('/public/sliders/'.$fileName,file_get_contents($file));
        $ruta='/public/sliders/'.$fileName;
        $rutaPublica='/storage/sliders/'.$fileName;

        $slider=  Slider::create([
            'nombre' => $request['nombre'],
            'link' => $request['link'],
            'estado' => $request['estado'],
            'ruta' => $ruta,
            'rutaPublica' => $rutaPublica
        ]);
       
       return Response::json($slider);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider  = Slider::find($id);
        return Response::json($slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'nombre' => 'required',
            'link' => 'required',
            'imagen' => 'mimes:jpeg|dimensions:max_width=2406,max_height=1038' 
        );

        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $slider = Slider::find($id);
        $nombreNuevo = $request['nombre'];
        $sliderentrante= Slider::where('nombre',$nombreNuevo)->first();
        $file = $request->file('imagen');
        
        if (empty($sliderentrante)) {

            if(empty($file)){
                $input=[
                    'nombre' => $request['nombre'],
                    'link' => $request['link'],
                    'estado' => $request['estado'],
                ];
            }else{

                Storage::disk('local')->delete($slider->ruta);
                
                $fileName = $file->getClientOriginalName();

                Storage::disk('local')->put('/public/sliders/'.$fileName,file_get_contents($file));
                $ruta='/public/sliders/'.$fileName;
                $rutaPublica='/storage/sliders/'.$fileName;
    
                $input=[
                    'nombre' => $request['nombre'],
                    'link' => $request['link'],
                    'estado' => $request['estado'],
                    'ruta' => $ruta,
                    'rutaPublica' => $rutaPublica
                ];
            }
            
            
            $slider->update($input);

        }elseif($sliderentrante->id==$slider->id){

            if(empty($file)){
                $input = [
                    'link' => $request['link'],
                    'estado' => $request['estado'],
                ];
            }else{
                Storage::disk('local')->delete($slider->ruta);
                
                $fileName = $file->getClientOriginalName();

                Storage::disk('local')->put('/public/sliders/'.$fileName,file_get_contents($file));
                $ruta='/public/sliders/'.$fileName;
                $rutaPublica='/storage/sliders/'.$fileName;
    
                $input=[
                    'link' => $request['link'],
                    'estado' => $request['estado'],
                    'ruta' => $ruta,
                    'rutaPublica' => $rutaPublica
                ];
            }
        
            $slider->update($input);
            
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe un slider con ese nombre']
                        ]);
        }
        
       return Response::json($slider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        Storage::disk('local')->delete($slider->ruta);
        $slider->delete();
        return Response::json($slider);
    }
}
