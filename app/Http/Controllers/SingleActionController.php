<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;


class SingleActionController extends Controller
{
    public function __invoke()
    {
        return 'invoked';
    }
}
