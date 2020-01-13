<?php

namespace App\Http\Controllers;

use App\Documento;
use App\User;
use Imagick;
use Toastr;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.perfil.index');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    
        $request->validate([
            'nombre'=>'required',
            'pass'=>'nullable|min:6'
        ]);
        $user= User::find(Auth::user()->id);
        if(empty ($request['pass'])){
            $pass=$user->password;
        }else{
            $pass=Hash::make($request['pass']);
        }
        $input = [
            'name' => $request['nombre'],
            'password' => $pass
        ];
       
        $user->update($input);
        Toastr::success('Actualizacion exitosa','Excelente!!!', 
        ["positionClass"=> "toast-top-right"]);
        return redirect()->back();
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
