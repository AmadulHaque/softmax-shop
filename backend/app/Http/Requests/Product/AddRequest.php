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
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images' => 'nullable|string',
            'summery' => 'required|string',
            'description'=> 'required',
            'category_id' => 'required|number',
            'brand_id'=> 'required|number',
            'unit_id'=> 'required|number',
            'size' => 'nullable',
            'color' => 'nullable',
            'qty' => 'nullable|number',
            'price' => 'required|number',
            'offer_price' => 'nullable|number',
            'tags' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
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