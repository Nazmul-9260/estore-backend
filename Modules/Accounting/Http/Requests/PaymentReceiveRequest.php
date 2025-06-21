<?php

namespace Modules\Accounting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentReceiveRequest extends FormRequest
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
            'receive_date' => ['required'],
            'received_by' => ['required'],
            'receive_type' => ['required', 'numeric'],
            'customer_id' => ['required'],
            'customer_name' => ['required'],
            'manual_mr_no' => ['required', 'max:100'],
            'bank_name' => ['nullable'],
            'account_name' => ['nullable'],
            'cheque_no' => ['nullable'],
            'cheque_date' => ['nullable'],
            'order_id' => ['required', 'array', 'min:1'],
            'payment_amount' => ['required', 'array', 'min:1'],
            'discount_amount' => ['required', 'array', 'min:1'],
            'remaining_amount' => ['array'],
            'is_advance_payment' => ['nullable', 'numeric']

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
