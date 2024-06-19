<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login', [
            'title' => 'Login Page'
        ]);
    }

    public function login_store(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        DB::beginTransaction();
        try {
            $email      = $request->email;
            $password   = $request->password;
            if (Auth::attempt(['email'=> $email, 'password'=> $password])) {
                $request->session()->regenerate();
                return redirect()->route('home');
            }
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function register()
    {
        return view('auth/login', [
            'title' => 'Login Page'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
