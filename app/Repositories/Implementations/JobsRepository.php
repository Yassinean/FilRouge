<?php

namespace App\Repositories\Implementations;

use App\Http\Requests\StoreJobsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\JobApplication;
use App\Models\Job;
use App\Models\User;
use App\Models\SavedJob;
use App\Models\CategoryJob;
use App\Models\TypeJob;
use App\Http\Requests\UpdatejobsRequest;
use App\Mail\JobNotificationEmail;
use App\Repositories\Interfaces\JobsInterface;



class JobsRepository implements JobsInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = CategoryJob::where('status', 1)->get();
        $types = TypeJob::where('status', 1)->get();

        $jobs = Job::where('status', 1);
        // Search using keyword
        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function ($query) use ($request) {
                $query->whereAny(['title', 'keywords'], 'like', '%' . $request->keyword . '%');
            });
        }

        // Search using location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location', 'like', '%' . $request->location . '%');
        }
        // Search using category
        if (!empty($request->category)) {
            $jobs = $jobs->where('category_job_id', $request->category);
        }
        $jobs = $jobs->with(['typeJob', 'categoryJob'])->orderBy('created_at', 'DESC')->paginate(9);


        $jobTypeArray = [];
        // Search using Job Type
        if (!empty($request->jobType)) {
            $jobTypeArray = explode(',', $request->jobType);

            $jobs = $jobs->whereIn('type_job_id', $jobTypeArray);
        }

        // Search using experience
        if (!empty($request->experience)) {
            $jobs = $jobs->where('experiences', $request->experience);
        }

        /*
        $jobs = Job::query()->with(['typeJob', 'categoryJob']);

        if ($request->sort == '0') {
            $jobs = $jobs->orderBy('created_at', 'ASC');
        } else {
            $jobs = $jobs->orderBy('created_at', 'DESC');
        }

        $jobs = $jobs->get();*/


        return view('front.jobs', compact('categories', 'types', 'jobs' ,'jobTypeArray'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TypeJob::orderBy('name', 'ASC')->where('status', 1)->get();
        $categories = CategoryJob::orderBy('name', 'ASC')->where('status', 1)->get();
        return view('front.account.job.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobsRequest $request): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), $request->rules());
        //dd($request);
        if ($validator->passes()) {
            $jobDetail = new Job();
            $jobDetail->title = $request->title;
            $jobDetail->location = $request->location;
            $jobDetail->vacancy = $request->vacancy;
            $jobDetail->user_id = Auth::user()->id;
            $jobDetail->salary = $request->salary;
            $jobDetail->description = $request->description;
            $jobDetail->category_job_id = $request->category_id;
            $jobDetail->type_job_id = $request->jobType;
            $jobDetail->keywords = $request->keywords;
            $jobDetail->responsabitilies = $request->responsibility;
            $jobDetail->qualifications = $request->qualifications;
            $jobDetail->experiences = $request->experiences;
            $jobDetail->company_name = $request->company_name;
            $jobDetail->company_location = $request->company_location;
            $jobDetail->company_website = $request->company_website;
            $jobDetail->save();

            session()->flash('success', 'Job added successfully!');
            return response()->json([
                'status' => true,
                'message' => 'Job details stored successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function getJob()
    {
        $jobs = Job::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('front.account.job.job', compact('jobs'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $job = Job::where([
            'id' => $id,
            'status' => 1
        ])->with(['typeJob','categoryJob'])->first();

        if($job == null){
            abort(404);
        }

        // fetching applicant that apply in the job
        $jobApplicants = JobApplication::where('job_id',$id)->get();

        //dd($jobApplicants);

        return view('front.detail',compact('job','jobApplicants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = CategoryJob::orderBy('name', 'ASC')->where('status', 1)->get();
        $types = TypeJob::orderBy('name', 'ASC')->where('status', 1)->get();

        $jobs = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id
        ])->first();
        if ($jobs == null) {
            abort(404);
        }

        return view('front.account.job.edit', compact('categories', 'types', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejobsRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [$request]);

        if ($validator->passes()) {

            $jobDetail = Job::find($id);
            $jobDetail->title = $request->title;
            $jobDetail->location = $request->location;
            $jobDetail->vacancy = $request->vacancy;
            $jobDetail->user_id = Auth::user()->id;
            $jobDetail->salary = $request->salary;
            $jobDetail->description = $request->description;
            $jobDetail->category_job_id = $request->category_id;
            $jobDetail->type_job_id = $request->jobType;
            $jobDetail->keywords = $request->keywords;
            $jobDetail->responsabitilies = $request->responsibility;
            $jobDetail->qualifications = $request->qualifications;
            $jobDetail->experiences = $request->experiences;
            $jobDetail->company_name = $request->company_name;
            $jobDetail->company_location = $request->company_location;
            $jobDetail->company_website = $request->company_website;
            $jobDetail->save();

            session()->flash('success', 'Job updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id)
    {

        $job = Job::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$job) {
            session()->flash('error', 'Either job was deleted or not found.');
            return redirect()->back();
        }

        $job->delete();
        session()->flash('success', 'Job deleted successfully.');
        return redirect()->back();

    }

    public function applyJob(Request $request) {
        $id = $request->id;

        $job = Job::where('id',$id)->first();

        // If job not found in db
        if ($job == null) {
            $message = 'Job does not exist.';
            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        // you can not apply on your own job
        $employer_id = $job->user_id;

        if ($employer_id == Auth::user()->id) {
            $message = 'You can not apply on your own job.';
            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        // You can not apply on a job twise
        $jobApplicationCount = JobApplication::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id
        ])->count();

        if ($jobApplicationCount > 0) {
            $message = 'You already applied on this job.';
            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }

        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();


        // Send Notification Email to Employer
        $employer = User::where('id',$employer_id)->first();

        $mailData = [
            'employer' => $employer,
            'user' => Auth::user(),
            'job' => $job,
        ];

        Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        $message = 'You have successfully applied.';

        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function saveJob(Request $request){
        $id = $request->id;
        $job = Job::find($id);
        if(Auth::user()->role == 'admin'){
            session()->flash('error','You are not allowed to save jobs');
            return response()->json([
                'status' => false
            ]);
        }
        if($job == null){
            session()->flash('error','Job not Found');
            return response()->json([
                'status' => false,
            ]);
        }
        // check if user already saved job
        $countSavedJob = SavedJob::where([
            'user_id'=> Auth::user()->id,
            'job_id'=> $id,
        ])->count();

        if($countSavedJob > 0 ){
            $message = 'You are already save this job';
            session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }
        $savedJob = new SavedJob();
        $savedJob->job_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();
        $message= 'You are saved this job successfully !';
        session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }
}
