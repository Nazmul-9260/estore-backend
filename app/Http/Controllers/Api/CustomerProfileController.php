<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CustomerProfileAddAddressApiRequest;
use App\Http\Resources\CustomerAddressResource;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CustomerProfileController extends Controller
{
    public function addAddress(CustomerProfileAddAddressApiRequest $request)
    {

        /**
         * Incoming post endpoint request structure
         * {
         * "address_type_id": 1,
         * "address_type": "Delivery",
         * "street_no": "34 Shyamoli",
         * "post_office": "Shymamoli",
         * "thana": "Shere Bangla Nogor",
         * "dist": "Dhaka",
         * "state": "Dhaka",
         * "country": "Bangladesh"
         * }
         */
        // return $request->all();

        $customer = $request->user();
        $customerId = $customer->id;
        $requestDto = new Request();
        $requestDto->merge(['customer_id' => $customerId]);
        $requestDto->merge(['address_type' => $request->address_type_id]);
        $requestDto->merge($request->only(['deliver_to', 'street_no', 'post_office', 'thana', 'division', 'dist', 'state', 'country', 'zip_code']));
        $customerAddress = CustomerAddress::create($requestDto->all());

        if ($customerAddress) {
            return response()->json([
                'status' => 'success',
                'message' => 'Customer Address Added Successfully',
                'data' => [
                    'new_customer_address' => CustomerAddressResource::make($customerAddress)
                ]
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed',
            ], 400);
        }
    }

    public function editAddress(Request $request, $customerAddressId)
    {
        $inputs = $request->all();

        $rules = [
            'customer_address_id' => ['required', 'numeric'],
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

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error occured.',
                'errors' => $validator->errors()
            ]);
        }

        $customer = $request->user();

        $customerAddress = CustomerAddress::where('id', $request->customer_address_id)->first();

        if ($customer->id != $customerAddress->customer_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer Address Invalid.',
                'errors' => ['customer address id is not valid']
            ]);
        }

        if ($request->filled('deliver_to')) {
            $customerAddress->deliver_to = $request->deliver_to;
        }
        if ($request->filled('street_no')) {
            $customerAddress->street_no = $request->street_no;
        }
        if ($request->filled('post_office')) {
            $customerAddress->post_office = $request->post_office;
        }
        if ($request->filled('thana')) {
            $customerAddress->thana = $request->thana;
        }
        if ($request->filled('dist')) {
            $customerAddress->dist = $request->dist;
        }
        if ($request->filled('division')) {
            $customerAddress->division = $request->division;
        }
        if ($request->filled('state')) {
            $customerAddress->state = $request->state;
        }
        if ($request->filled('country')) {
            $customerAddress->country = $request->country;
        }
        if ($request->filled('zip_code')) {
            $customerAddress->zip_code = $request->zip_code;
        }

        $customerAddress->updated_by = $request->user()->id;

        $customerAddress->updated_at = Carbon::now();

        $customerAddress->save();

        $customer->load(['customerDetails', 'customerAddress']);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Customer Address Updated Successfully',
            'data' => [
                'customer' => $customer
            ]
        ], 200);
    }

    public function setDefaultAddress(Request $request)
    {
        $customer = $request->user();
        $inputs = $request->all();
        $rules = [
            'customer_address_id' => ['required', function ($attr, $val, $fail)  use ($customer) {
                $customerAddress = CustomerAddress::find($val);
                if ($customer->id != $customerAddress->customer_id) {
                    $fail('The customer_address_id is invalid, its not your address');
                }
            }],
            'make_default' => ['required', 'numeric', 'in:1']
        ];

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => 'Validation error occured',
                'errors' => $validator->errors()
            ]);
        }

        $customerAddress = CustomerAddress::find($request->input('customer_address_id'));
        // return $customerAddress;
        $customerAddressTypeId = $customerAddress->address_type;
        // return $customerAddressTypeId;
        $customerAddressListofType = CustomerAddress::where('customer_id', $customer->id)->where('address_type', $customerAddressTypeId)->get();
        // return response()->json([
        //     'data' => $customerAddressListofType
        // ], 200);
        foreach ($customerAddressListofType as $customerAddressType) {
            if ($customerAddressType->is_default == 1) {
                if ($customerAddressType->id != $request->input('customer_address_id')) {
                    $customerAddressType->is_default = 0;
                    $customerAddressType->save();
                }
            }
        }

        $customerAddress->is_default = 1;
        $customerAddress->save();
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Default address changed successfully',
            'data' => [
                'updated_address' => $customerAddress
            ]
        ]);
    }

    public function addPersonalInfo(Request $request)
    {
        // return 'OK';
        //return $request->all();

        $inputs = $request->all();

        $rules = [
            'name' => 'nullable',
            'email' => 'nullable|email'
        ];

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error occured.',
                'errors' => $validator->errors()
            ]);
        }
        if (!$request->filled('name') && !$request->filled('email')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error occured.',
                'errors' => 'You have to provide at least one personal info like name or email'
            ]);
        }

        $customer = $request->user();

        $customerDetails = new CustomerDetails();

        $customerDetails->customer_id = $request->user()->id;

        $customerDetails->created_by = $request->user()->id;

        if ($request->filled('name')) {
            $customerDetails->name = $request->name;
        }

        if ($request->filled('email')) {
            $customerDetails->email = $request->email;
        }

        $customerDetails->save();

        $customer->load(['customerDetails', 'customerAddress']);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Personal Information Added Successfully',
            'data' => [
                'customer' => $customer
            ]
        ], 200);
    }

    public function updatePersonalInfo(Request $request)
    {
        // return 'OK';
        // return $request->all();

        $inputs = $request->all();

        $rules = [
            'name' => 'required',
            'email' => 'required|email'
        ];

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error occured.',
                'errors' => $validator->errors()
            ]);
        }

        $customer = $request->user();

        $customerDetails = CustomerDetails::where('customer_id', $customer->id)->first();

        $customerDetails->name = $request->name;

        $customerDetails->email = $request->email;

        $customerDetails->save();

        $customer->load(['customerDetails', 'customerAddress']);

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Personal Information Updated Successfully',
            'data' => [
                'customer' => $customer
            ]
        ], 200);
    }
}
