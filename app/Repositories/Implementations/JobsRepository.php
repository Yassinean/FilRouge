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
use Mockery\Exception;


class JobsRepository implements JobsInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       // dd($request->all());
        $categories = CategoryJob::where('status', 1)->get();
        $types = TypeJob::where('status', 1)->get()  ;

        $jobs = Job::where('status', 1);
        // Search using keyword
        if (!empty($request->keyword)) {
            $jobs = $jobs->whereAny(['title', 'keywords'], 'like', '%' . $request->keyword . '%');
        }

        // Search using location
        if (!empty($request->location)) {
            $jobs = $jobs->where('location', 'like', '%' . $request->location . '%');
        }
        // Search using category
        if (!empty($request->category)) {
            $jobs = $jobs->where('category_job_id', $request->category);
        }


        // Search using Job Type
        if (!empty($request->job_type)) {

            $jobs = $jobs->where('type_job_id', $request->job_type);
        }

        // Search using experience
        if (!empty($request->experience)) {
            $jobs = $jobs->where('experiences', $request->experience);
        }


        $jobs = $jobs->with(['typeJob', 'categoryJob']);

        $jobs = $jobs->paginate(6);


        return view('front.jobs', compact('categories', 'types', 'jobs'));
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
    public function store(array $validatedData): \Illuminate\Http\JsonResponse
    {
        try {
            $jobDetail = Job::create([
                'title' => $validatedData['title'],
                'location' => $validatedData['location'],
                'vacancy' => $validatedData['vacancy'],
                'user_id' => Auth::user()->id,
                'salary' => $validatedData['salary'],
                'description' => $validatedData['description'],
                'category_job_id' => $validatedData['category_id'],
                'type_job_id' => $validatedData['jobType'],
                'keywords' => $validatedData['keywords'],
                'responsabitilies' => $validatedData['responsibility'],
                'qualifications' => $validatedData['qualifications'],
                'experiences' => $validatedData['experiences'],
                'company_name' => $validatedData['company_name'],
                'company_location' => $validatedData['company_location'],
                'company_website' => $validatedData['company_website'],
            ]);

            session()->flash('success', 'Job added successfully!');
            return response()->json([
                'status' => true,
                'message' => 'Job details stored successfully',
            ]);
        } catch (Exception) {
            return response()->json([
                'status' => false,
                'errors' => $validatedData->errors(),
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
        ])->with(['typeJob', 'categoryJob'])->first();

        if ($job == null) {
            abort(404);
        }

        // fetching applicant that apply in the job
        $jobApplicants = JobApplication::where('job_id', $id)->get();

        //dd($jobApplicants);

        return view('front.detail', compact('job', 'jobApplicants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = CategoryJob::orderBy('name', 'ASC')->where('status', 1)->get();
        $types = TypeJob::orderBy('name', 'ASC')->where('status', 1)->get();


        $jobs = Job::with('categoryJob','typeJob')->where([
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
    public function update(UpdateJobsRequest $request, $id)
    {

       $validatedData = $request->validated();

        $validator = Validator::make($validatedData, $request->rules());

        if ($validator->passes()) {

            $jobDetail = Job::find($id);

            $jobDetail->update($validatedData);
            dd($jobDetail);
            return redirect()->back()->with('success', 'Job updated successfully.');
        } else {
            return redirect()->back()->with('errors','Something went wrong');
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


    public function applyJob(Job $job)
    {
        $id = $job->id;
        // Check if user is applying to their own job
        if ($job->user_id == Auth::user()->id || Auth::user()->role === 'employer' || Auth::user()->role === 'admin') {
            $message = 'You cannot apply to jobs.';
            return back()->with([
                'status' => false,
                'error' => $message
            ]);
        }

        // Check if user has already applied to this job
        $jobApplicationCount = JobApplication::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id
        ])->count();
        if ($jobApplicationCount > 0) {
            $message = 'You have already applied to this job.';
            return back()->with([
                'status' => false,
                'error' => $message
            ]);
        }

        // Create a new job application
        $application = new JobApplication();
        $application->job_id = $id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $job->user_id;
        $application->applied_date = now();
        $application->save();

        // Send Notification Email to Employer
        $employer = User::findOrFail($job->user_id);

        $mailData = [
            'employer' => $employer,
            'user' => Auth::user(),
            'job' => $job,
        ];

        Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        return redirect()->back()->with('success','You have successfully applied');
    }

    public
    function saveJob(Job $job)
    {
        $id = $job->id;
        $job = Job::find($id);
        if (Auth::user()->role == 'admin') {
            return redirect()->back()->with('error', 'You are not allowed to save jobs');

        }
        if ($job == null) {
            return redirect()->back()->with('error', 'Job not Found');
        }
        // check if user already saved job
        $countSavedJob = SavedJob::where([
            'user_id' => Auth::user()->id,
            'job_id' => $id,
        ])->count();
        if ($job->user_id == Auth::user()->id) {
            $message = 'You cannot save your own job.';
            return back()->with([
                'status' => false,
                'error' => $message
            ]);
        }

       if ($countSavedJob > 0) {
            return redirect()->back()->with('error', 'You are already save this job');
        }
        $savedJob = new SavedJob();
        $savedJob->job_id = $id;
        $savedJob->user_id = Auth::user()->id;
        $savedJob->save();
        return redirect()->back()->with('success', 'You are saved this job successfully !');

    }
}
