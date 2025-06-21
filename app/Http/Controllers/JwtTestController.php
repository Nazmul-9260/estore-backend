<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JwtTestController extends Controller
{

    public function __construct() {}

    public function index()
    {
        return "OK";
    }
}
