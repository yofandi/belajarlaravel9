<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // menentukan key apa saja yang akan diambil atau digunakan. sehingga perlu ada guard atau pembatasan melalui method only()
        $credentials = $request->only('email', 'password');

        // melakuakan pengecekan email dan password melalui auth:class
        if (Auth::attempt($credentials)) {
            return redirect()->route('post.index')->with('success', 'Authenticate successfuly');
        } else {
            return redirect()->route('login')->with('error_message', 'Wrong email or password');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        // dd(Auth::getUser());
        // untuk melakukan validasi ditiap input request
        $input = $request->input();

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]
        );

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        return redirect()->route('login');
    }
}
