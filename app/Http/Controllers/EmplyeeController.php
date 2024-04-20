<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmplyeeRequest;
use App\Http\Requests\UpdateEmplyeeRequest;
use App\Models\Admin;
use App\Models\Education;
use App\Models\Emplyee;
use App\Models\Emplyer;
use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmplyeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmplyeeRequest $request)
    {
        $validateData = Validator::make($request->all(), [
            'education' => 'required',
            'experience' => 'required',
            'certification' => 'required',
            'cv' => 'required|image',
        ]);

        if ($validateData->passes()) {
            $employee = Education::create([
                'education'=> $request->education,
                'experience'=> $request->experience,
                'certification'=> $request->certification,
                'cv'=> $request->cv,
            ]);

            dd($employee);

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

    /**
     * Display the specified resource.
     */
    public function show(Emplyee $emplyee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emplyee $emplyee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmplyeeRequest $request, Emplyee $emplyee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emplyee $emplyee)
    {
        //
    }

    public function appliedJob()
    {
        $user_id = Auth::id();
        $jobApplications = JobApplication::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('front.account.job.job-application', compact('jobApplications'));
    }

    public function savedJob()
    {
        $user_id = Auth::id();
        $jobSaved = SavedJob::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('front.account.job.job-save', compact('jobSaved'));
    }

    public function removeJob()
    {
        $jobApp = new JobApplication();
        $jobApplication = JobApplication::where([
            ['user_id', Auth::user()->id],
        ])->first();

        // Check if the job application exists
        if ($jobApplication == null) {
            session()->flash('error', 'This job application was not found.');
            return response()->json(['status' => false]);
        }

        // Delete the job application
        $jobApplication->delete();

        session()->flash('success', 'Your application for this job has been removed successfully.');
        return redirect()->back();
    }

    public function removeSavedJob()
    {
        $jobSave = new JobApplication();
        $jobSaved = SavedJob::where([
            ['user_id', Auth::user()->id],
        ])->first();

        // Check if the job application exists
        if ($jobSaved == null) {
            session()->flash('error', 'This job application was not found.');
            return response()->json(['status' => false]);
        }

        // Delete the job application
        $jobSaved->delete();

        session()->flash('success', 'Your saved job has been removed successfully.');
        return redirect()->back();
    }
}
