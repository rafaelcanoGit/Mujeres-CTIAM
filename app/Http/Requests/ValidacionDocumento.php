<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionDocumento extends FormRequest
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
                'descripcion' => 'required'
            ];
        }else{
            return [
                'documento' => 'required|mimes:docx,doc,pdf,pptx,xlsx',
                'descripcion' => 'required'
            ];
        }
    }
}
