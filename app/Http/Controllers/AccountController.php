<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        if ($validateData) {
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
}