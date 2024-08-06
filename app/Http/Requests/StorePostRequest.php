<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','min:10'],
            'image_products'=>['required','image_products'],
            'description'=>['required','min:10'],
            'content'=>['required','min:10'],
            'view'=>['required','min:0'],
        ];
    }
    public function messages()
    {
        return [

            'title.required'=>'title khong duoc thong bao',
            'title.min'=>'title ngan qua',
            'description.required'=>'description ngan qua',
            'description.min'=>'description ngan qua',
            'content.required'=>'content ngan qua',
            'content.min'=>'content ngan qua',
            'view.required'=>'view ngan qua',
            'view.min'=>'view ngan qua',
            'image_products.required'=>'image_products ngan qua',
            'image_products.min'=>'image_products ngan qua',
        ];
    }
}
