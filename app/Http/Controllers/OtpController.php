<?php

namespace App\Http\Controllers;

use App\Jobs\SendOtpJob;
use App\Mail\SendOtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function sendOtp()
    {
        $otp = rand(100000, 999999);
        dispatch(new SendOtpJob($otp))->onQueue('high');

        // Mail::to('userotp@gmail.com')->send(new SendOtpMail($otp));
    }

    

}
