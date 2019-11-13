<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $rules=[
            'name' => 'required',
            'last_name' => 'required',
            //'branchOffice'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'sex'=>'max:1',
            'email'=>['required',Rule::unique('users')->ignore($this->route('user')->id)],
        ];

        if($this->filled('password')){
            $rules['password']=['confirmed','min:8'];
        }

        return $rules;
    }
    public function messages()
    {
        $messages=[
            'name.required'=>'El campo Nombre es obligatorio.',
            'last_name.required'=>'El campo Apellido es obligatorio.',
            'branchOffice.required'=>'El campo Sucursal es obligatorio.',
            'address.required'=>'El campo Dirección es obligatorio.',
            'phone.required'=>'El campo Teléfono es obligatorio.',
            'email.required'=>'El campo Email es obligatorio.',
            'sex.max'=>'El campo Sexo no debe contener más de 1 caracteres.',
        ];
        return $messages;
    }
}
