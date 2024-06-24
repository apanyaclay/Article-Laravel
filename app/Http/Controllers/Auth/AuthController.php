<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'password'  => 'required|min:8',
        ]);

        DB::beginTransaction();
        try {
            $email      = $request->email;
            $password   = $request->password;
            if (Auth::attempt(['email'=> $email, 'password'=> $password])) {
                $request->session()->regenerate();
                return redirect()->route('dashboard')->with('success', __('auth.login'));
            } else {
                return redirect()->back()->withErrors(__('auth.failed'));
            }
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function register()
    {
        return view('auth/register', [
            'title' => 'Register Page'
        ]);
    }

    public function register_store(Request $request)
    {
        $request->validate([
            'name'                      => 'required',
            'email'                     => 'required|email|unique:users,email',
            'password'                  => 'required|confirmed|min:8',
            'password_confirmation'     => 'required|same:password',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);
            $user->syncRoles('user');
            DB::commit();
            return redirect()->route('login')->with('success', __('auth.register'));
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', __('auth.logout'));
    }
}
