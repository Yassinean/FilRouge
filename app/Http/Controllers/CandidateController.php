<?php

namespace App\Http\Controllers;

use App\Models\Emplyee;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $employees = Emplyee::all();
        return view('front.candidates', compact('employees'));
    }
}
