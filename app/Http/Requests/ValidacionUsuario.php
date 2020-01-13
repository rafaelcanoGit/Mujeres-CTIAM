<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionUsuario extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->route('id')){
            return [
                'nombre' => 'required',
                'pass' => ' nullable|min:6'
            ];
        }else{
            return [
                'nombre' => 'required',
                'email' => 'required|unique:users,email',
                'pass' => 'required|min:6'
            ];
        }
  
    }
}
