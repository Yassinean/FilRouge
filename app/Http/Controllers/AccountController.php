<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Emplyee;
use App\Models\Emplyer;
use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Http\Request;
//use \Illuminate\Support\Facades\Request;
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
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:confirm_password',
            'role' => 'required ',
        ]);

        if ($validateData->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            if ($request->role === 'employer') {
                Emplyer::create(['user_id' => $user->id]);
            } elseif ($request->role === 'employee') {
                Emplyee::create(['user_id' => $user->id]);
            } elseif ($request->role === 'admin') {
                Admin::create(['user_id' => $user->id]);
            }

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
        $userID = Auth::id();
        // $userData = User::where('id', $userID)->first();
        $user = User::findOrFail($userID);

        return view('front.account.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $userID = Auth::id();
        $validateData = validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $userID . ',id',
        ]);
        if ($validateData->passes()) {
            $user = User::find($userID);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

            session()->flash('success', 'Profile updated successfuly');
            $message_view = view('components.message')->render();
            return response()->json([
                'status' => true,
                'message' => $message_view,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validateData->errors(),
            ]);
        }
    }

    public function updateProfilePic(Request $request)
    {
        $userID = Auth::id();
        $validator = validator::make($request->all(), [
            'image' => 'required|image'
        ]);
        if ($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $userID.'-'.time().'.'.$ext;
            $image->move(public_path('assets/profile_pic/',$imageName));

            User::where('id',$userID)->update(['image' => $imageName]);

            session()->flash('success','Profile picture updated successfully');
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function appliedJob(){
        $user_id = Auth::id();
        $jobApplications = JobApplication::where('user_id',$user_id)->get();
        return view('front.account.job.job-application', compact('jobApplications'));
    }
    public function savedJob(){
        $user_id = Auth::id();
        $jobSaved = SavedJob::where('user_id',$user_id)->get();
        return view('front.account.job.job-save', compact('jobSaved'));
    }

    public function removeJob(){
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
    public function removeSavedJob(){
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
