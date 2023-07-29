<?php

namespace App\Http\Requests\Product;

use App\Http\Resources\ErrorResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AddRequest extends FormRequest
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
            'title' => 'required|string|unique:products',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'summery' => 'required|string',
            'description'=> 'required',
            'category_id' => 'required|numeric',
            'brand_id'=> 'required|numeric',
            'unit_id'=> 'required|numeric',
            'qty' => 'nullable|numeric',
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable',
            'tags' => 'nullable',
            'size' => 'nullable',
            'color' => 'nullable',
            'meta_desc' => 'nullable|string',
            'status' => 'nullable',
            'trending' => 'nullable',
        ];
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = (new ErrorResource($validator->errors()))->response()->setStatusCode(200);
        throw new ValidationException($validator, $response);
    }
}