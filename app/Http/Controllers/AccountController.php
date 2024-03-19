<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    //this function will show us register page 
    public function register(){
        return view('front.account.register');
    }
    
    //this function will show us login page 
    public function login(){
        return view('front.account.login');
    }
}