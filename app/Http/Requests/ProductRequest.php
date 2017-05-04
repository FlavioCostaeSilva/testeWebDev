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
     * @return array
     */
    public function rules()
    {
        return [
            'lm' => 'integer',
            'name' => 'required|max:250',
            'category' => 'required|max:250',
            'free_shipping' => 'required|boolean',
            'price' => 'required|numeric'
        ];
    }
}
