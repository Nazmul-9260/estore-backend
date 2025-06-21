<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\Customer;
use Carbon\Carbon;
use App\Services\SmsService;

class OtpService
{
    public function generateOtp($customerId)
    {
        $otpCode = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(2);
        $otp = new Otp();
        $otp->otp_code = $otpCode;
        $otp->expires_at = $expiresAt;
        $otp->customer_id = $customerId;
        $otpCodeCreated = $otp->save();
        if ($otpCodeCreated) {
            // Send Push Notification/SMS to customer
            $customer = Customer::findOrFail($otp->customer_id);
            $msg = "Your Saffron Corporation Limited Login OTP Code is " . $otp->otp_code;
            $response = SmsService::send($customer->user_id, $msg);
            return
                $otp->otp_code;
        } else {
            return false;
        }
    }
}
