<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_phone' => 'required|numeric|digits:10',
            'customer_email' => 'email|nullable',
            'requested_product_image' => 'required|file|mimes:png,jpg,jpeg',
        ];
    }
    public function messages()
    {
        return [
            'customer_phone.required' => 'Phone number is must be required.',
            'customer_phone.numeric' => 'Phone number must be numeric.',
            'customer_phone.digits' => 'Phone number must be 10 digit.',
            'customer_email.email' => 'Please enter valid email.',
            'requested_product_image.required' => 'Image is must be required.',
            'requested_product_image.file' => 'Image must be file.',
            'requested_product_image.mimes' => 'Image must be png, jpg, jpeg.',
        ];
    }
    protected function failedValidation(Validator $validator) {
        $validationErrorResponse = [];
        $errors = $validator->errors();
        if($errors->has('customer_email')){
            $validationErrorResponse['error_msg'] = $errors->get('customer_email')[0]; // Get the first error message
        }else if($errors->has('customer_phone')){
            $validationErrorResponse['error_msg'] = $errors->get('customer_phone')[0]; // Get the first error message
        }
        else if ($errors->has('requested_product_image')) {
            $validationErrorResponse['error_msg'] = $errors->get('requested_product_image')[0]; // Get the first error message
        }
        throw new HttpResponseException(response()->json($validationErrorResponse, 422));
    }
}
