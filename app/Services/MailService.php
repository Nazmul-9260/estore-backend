<?php

namespace App\Services;

use App\Mail\OrderConfirmed;
use App\Mail\TestMail;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function send()
    {
        $to = "mobinashikmeher@gmail.com";

        Mail::to($to)->send(new TestMail());
        return "email sending event fired.";
    }

    public static function sendOrderConfirmation($customerId)
    {
        $customer = Customer::where('id', $customerId)->first();
        $customerName = $customer->customerDetails->name;
        $customerEmail = $customer->customerDetails->email;

        try {
            Mail::to($customerEmail)->send(new OrderConfirmed($customerName));
            return true;
        } catch (Exception $ex) {
            $exceptionMsg = $ex->getMessage();
            return $exceptionMsg;
        }
    }
}
