<?php

namespace App\Http\Controllers;

use App\Models\Emplyee;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $employees = Emplyee::all();
        $employees->load('user');
        return view('front.candidates', compact('employees'));
    }

    public function profileCandidate($id)
    {
        $employeeProfile = Emplyee::where('id',$id)->first();
        return view('front.candidate-profile',compact('employeeProfile'));
    }
}
