<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    //todo: admin login form
    public function loginForm()
    {
        return view('admin.login-form');
    }

    //todo: admin login functionality
    public function loginFunctionality(LoginRequest $request)
    {
        $credentials = $request->validated();
        /* dd($credentials); */
        try {
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
            } else {
                return back()->withErrors([
                    'Wrong credentails'
                ]);
            }
        } catch (Exception $e) {
            abort(500, 'something went wrong');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    //todo: admin logout functionality
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginn');
    }
}
