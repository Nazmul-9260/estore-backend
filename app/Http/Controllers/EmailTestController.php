<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MailService;

class EmailTestController extends Controller
{
    //

    public function sendTestMail()
    {

        $success =  MailService::send();

        return $success;
    }
}
