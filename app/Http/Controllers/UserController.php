<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function log_out()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
