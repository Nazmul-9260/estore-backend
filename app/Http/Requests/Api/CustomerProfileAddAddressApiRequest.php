<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CustomerProfileAddAddressApiRequest extends FormRequest
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
            // "address_type_id" => ["required", "numeric"],
            // "address_type" => ["required", "string"],
            // "street_no" => ["required", "string"],
            // "post_office" =>  ["required", "string"],
            // "thana" => ["required", "string"],
            // "dist" => ["required", "string"],
            // "state" => ["required", "string"],
            // "country" => ["required", "string"],
            //  Updated ->
            'address_type_id' => ['required', 'numeric'],
            'address_type' => ['required'],
            'deliver_to' => ['required'],
            'street_no' => ['required'],
            'post_office' => ['nullable'],
            'thana' => ['string', 'nullable'],
            'division' => ['nullable'],
            'dist' => ['string', 'nullable'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
            'zip_code' => ['required']
        ];
    }
}
