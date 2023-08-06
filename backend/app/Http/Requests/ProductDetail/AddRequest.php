<?php

namespace App\Http\Requests\ProductDetail;

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
            'product_id' => 'required|string|max:200|unique:product_details',
            'title' => 'required|string|min:2|max:200|unique:product_details',
            'sub_title' => 'nullable',
            'video_one_url' => 'nullable',
            'important_title' => 'nullable',
            'PD_important_id' => 'nullable',
            'important_desc' => 'nullable',
            'PD_learn_title' => 'nullable',
            'PD_learn_id' => 'nullable',
            'gift_id' => 'nullable',
            'PD_image_one' => 'nullable',
            'PD_image_two' => 'nullable',
            'video_two_title' => 'nullable',
            'video_two_url' => 'nullable',
            'video_desc' => 'nullable',
            'review_title' => 'nullable',
            'review_video' => 'nullable',
            'review_desc' => 'nullable',
            'review_images' => 'nullable',
            'order_title' => 'nullable',
            'order_image' => 'nullable',
            'motive_title' => 'nullable',
            'order_video_url' => 'nullable',
            'motive_title_two' => 'nullable',
            'qa_id' => 'nullable',
            'book_review_id' => 'nullable',
            'book_news_title' => 'nullable',
            'book_news_id' => 'nullable'
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