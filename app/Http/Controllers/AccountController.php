<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    //this function will show us register page 
    public function register()
    {
        return view('front.account.register');
    }

    //this method will save user
    public function processRegistration(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validateData->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name,

            ]);
            session()->flash('success', 'You have registered Successfully');
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validateData->errors()
            ]);
        }
    }

    //this function will show us login page 
    public function login()
    {
        return view('front.account.login');
    }

    public function authenticate(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validateData->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.profile')->with('success', 'You are Logged Successfully');
            } else {
                return redirect()->route('account.login')->with('error', 'Email or Password is incorrect');
            }
        } else {
            return redirect()->route('account.login')->withErrors($validateData)->withInput($request->only('email')); // withInput kat7afd lina 3la values li f l input o only kat7afd lina 3la value dyal achln input bina
        }
    }

    public function profile()
    {
        return view('front.account.account');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}