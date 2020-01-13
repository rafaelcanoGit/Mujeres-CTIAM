<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionAudioVisual extends FormRequest
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
                'nombre' => 'required|unique:audiovisual,nombre', 
                'descripcion' => 'required'
            ];
        }else{
            return [
            'audiovisual' => 'required|mimes:mp3,mp4',
            'descripcion' => 'required'
        ];
        }
        
    }
}
