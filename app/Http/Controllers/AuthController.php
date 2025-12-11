<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login.form')->with('success', 'Registrasi berhasil!');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);

        $loginInput = $request->input('email');
        $password = $request->input('password');

        // 1) Try admin login (users table) when input is an email
        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $loginInput, 'password' => $password];
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                // remove any student session if present
                $request->session()->forget(['student_id', 'student_nim']);
                return redirect('/students')->with('success', 'Login sukses!');
            }
        }

        // 2) Try student login by NIM (username & password both NIM)
        $student = Student::where('nim', $loginInput)->first();
        if ($student && $password === $student->nim) {
            // mark student as "logged in" via session (custom)
            $request->session()->regenerate();
            $request->session()->put('student_id', $student->id);
            $request->session()->put('student_nim', $student->nim);
            // ensure Auth user is logged out
            Auth::logout();
            return redirect('/students')->with('success', 'Login siswa sukses!');
        }

        return back()->withErrors([
            'email' => 'Email/NIM atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        // logout for admin guard
        Auth::logout();

        // remove student session if any
        $request->session()->forget(['student_id', 'student_nim']);

        // invalidate session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
