<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index () {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.auth.login');
    }

    public function action(LoginRequest $request) {
        if (!$request->validated()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to login. Please check again your data.',
                'errors' => $request->errors(),
            ]);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Username or password are incorrect.',
            ]);
        }

        if (!password_verify($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username or password are incorrect.',
            ]);
        }

        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Login successfully.',
            'data' => $user
        ]);
    }
}
