<?php

namespace App\Http\Controllers;

use App\User;
use App\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str as IlluminateStr;
use Psy\Util\Str;
use App\Http\Requests\ValidacionUsuario;
use Toastr;
use Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposusuarios = TipoUsuario::orderBy('id')->get();
        return view('theme.usuarios.index',compact('tiposusuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* $tiposusuarios = TipoUsuario::orderBy('id')->get();
        return view('theme.usuarios.agregar',compact('tiposusuarios'));*/
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
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email',
            'pass' => 'required|min:6'
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $user= User::create([
            'name' => $request['nombre'],
            'email' => $request['email'],
            'tipousuario_id' => $request['tipousuario'],
            'is_admin' =>0,
            'password' => Hash::make($request['pass'])
            ]);

        return Response::json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $usuario = User::find($id);  
        return Response::json($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)
    {   
        $rules = array(
            'nombre' => 'required',
            'pass' => ' nullable|min:6'
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user= User::find($id);
        if(empty ($request['pass'])){
            $pass=$user->password;
        }else{
            $pass=Hash::make($request['pass']);
        }
        $input = [
            'name' => $request['nombre'],
            'email' => $request['email'],
            'tipousuario_id' => $request['tipousuario'],
            'password' => $pass
        ];
       
        $user->update($input);

        return Response::json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user=User::where('id',$id)->delete();
        return Response::json($user);
    }
}
