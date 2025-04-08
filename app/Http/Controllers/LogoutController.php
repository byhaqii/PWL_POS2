<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function action() {
        Auth::logout();
        return redirect()->route('auth.login-page');
    }
}
