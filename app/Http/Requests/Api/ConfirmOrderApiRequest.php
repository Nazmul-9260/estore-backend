<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConfirmOrderApiRequest extends FormRequest
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
            'order_date' => ['required'],
            'customer_id' => ['required'],
            'order_status' => ['required'],
            'discount_percentage' => ['required', 'numeric', 'max:100'],
            'total_discount' => ['required', 'numeric'],
            'vat_percentage' => ['required', 'numeric', 'max:100'],
            'order_amount' => ['required', 'numeric'],
            'total_vat' => ['required', 'numeric'],
            'grand_total' =>  ['required', 'numeric'],
            'delivery_charge' => ['nullable', 'numeric'],
            'bill_address_id' => ['required', 'numeric'],
            // 'delivery_address_id' => ['required', 'numeric'],
            'order_lines' => ['required', 'array', 'min:1'],
            'order_lines.*.product_id' => ['required', 'numeric'],
            'order_lines.*.quantity' => ['required', 'numeric'],
            'order_lines.*.unit_price' => ['required', 'numeric']
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        $response =  response()->json([
            'status' => 'error',
            'message' => 'Request data validation failed',
            'errors' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }
}
