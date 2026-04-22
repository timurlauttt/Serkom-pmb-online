<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to find user by username stored in `name` column
        $user = User::where('name', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
        }

        // login using the guard
        Auth::login($user);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,name',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->username,
            // email is required by users table - create a placeholder
            'email' => $request->username . '@local',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}
