<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        Users::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active_status' => 'Y',
            'created_at' => now()
        ]);

        return redirect()->route('auth.login')->with('success', 'Registration successful');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $request->username,'password' => $request->password]))
        { $user = Auth::user();

            if ($user->active_status != 'Y') {
                Auth::logout();
                return back()->with('error', 'User inactive');
            }

            return redirect()->route('hr.index');
        }

        return back()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
