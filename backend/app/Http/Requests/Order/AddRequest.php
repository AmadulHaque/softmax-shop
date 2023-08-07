<?php

namespace App\Http\Requests\Order;

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
            'customer_id' => 'required|numeric',
            'shipping'=> 'nullable|numeric',
            'discount'=> 'nullable|numeric',
            'tax'=> 'nullable|numeric',
            'name' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'pay_type' => 'required',
            'pay_number' => 'nullable',
        ];
    }
    
// customer_id
// shipping
// discount
// name
// email
// postal_code
// phone
// address
// pay_type
// pay_number


    /**
     * 
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