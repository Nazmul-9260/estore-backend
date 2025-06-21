<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Otp extends Model
{
    use HasFactory;

    protected $table = 'otps';

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function isExpired()
    {
        return $this->expires_at < Carbon::now()->timezone('Asia/Dhaka');
    }

    // Documentation
    //
    // eq() equals
    // ne() not equals
    // gt() greater than
    // gte() greater than or equals
    // lt() less than
    // lte() less than or equals
    // Usage:
    // if($model->edited_at->gt($model->created_at)){
    //     // edited at is newer than created at
    // }
    // Workaround  set timezone not for comparison
    // 1. 
    // if ($otp->expires_at < Carbon::now()->setTimezone(config('app.timezone'))) {
    //     // OTP is expired
    // }
    // if ($otp->expires_at->timezone(config('app.timezone')) < Carbon::now()) {
    //     // OTP is expired
    // }
}
