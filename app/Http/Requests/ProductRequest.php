<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category_id' => 'required',
            'status' => 'required|in:active,disabled',
        ];
    }

    public function messages(): array
    {
        return [
            'document.required' => 'El campo Documento de identidad es obligatorio.',
            'document.integer' => 'El campo Documento de identidad debe ser un número entero.',
            'document.min' => 'El campo Documento de identidad debe tener al menos :min caracteres.',
            'documentType.required' => 'El campo Tipo de documento es obligatorio.',
            'documentType.in' => 'El campo Tipo de documento debe ser uno de los siguientes valores: CC, CE, TI, NIT, RUT.',
            'name.required' => 'El campo Nombre es obligatorio.',
            'name.alpha' => 'El campo Nombre solo puede contener letras.',
            'surname.required' => 'El campo Apellido es obligatorio.',
            'surname.alpha' => 'El campo Apellido solo puede contener letras.',
            'email.required' => 'El campo Correo Electrónico es obligatorio.',
            'email.email' => 'El campo Correo Electrónico debe ser una dirección de correo válida.',
            'mobile.required' => 'El campo Número de teléfono es obligatorio.',
            'mobile.integer' => 'El campo Número de teléfono debe ser un número entero.',
            'address.required' => 'El campo Información de dirección es obligatorio.',
            'address.max' => 'El campo Información de dirección no puede exceder los :max caracteres.',
            'address.regex' => 'El campo Información de dirección solo puede contener letras y espacios.',
            'payment_method.required' => 'El campo Medio de Pago es obligatorio.',
        ];
    }
}
