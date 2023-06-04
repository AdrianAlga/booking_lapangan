<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisController extends Controller
{
    public function loginView()
    {
        return view("login", [
            "title" => "Login",
        ]);
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            if ($user->level == 1) {
                return redirect()->route('admin.field.index');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('loginError', 'Email atau password salah.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function regisView()
    {
        return view("register", [
            "title" => "Registrasi",
        ]);
    }

    public function regisProcess(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        return redirect()->route('login')->with("success", "Registrasi Berhasil");
    }
}
