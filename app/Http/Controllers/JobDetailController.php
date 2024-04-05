<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\TypeJob;
use App\Models\CategoryJob;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreJobDetailRequest;

class JobDetailController extends Controller
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
        $types = TypeJob::orderBy('name', 'ASC')->where('status',1)->get();
        $categories = CategoryJob::orderBy('name', 'ASC')->where('status',1)->get();
        return view('front.account.job.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobDetailRequest $request)
    {
        $rules = [
                'title' => 'required|min:5|max:50',
                'category' => 'required',
                'jobType' => 'required',
                'vacancy' => 'required',
                'location' => 'required|max:70',
                'description' => 'required:',
                'company_name' => 'required|min:3|max:50',
                'experiences' => 'required',
            ];
        $validator = Validator::make($request->all(), $rules);
        //dd($request);
        if ($validator->passes()) {
            $jobDetail = new JobDetail();
            $jobDetail->title = $request->title;
            $jobDetail->location = $request->location;
            $jobDetail->vacancy = $request->vacancy;
            $jobDetail->status = $request->status;
            $jobDetail->salary = $request->salary;
            $jobDetail->description = $request->description;
            $jobDetail->category_id = $request->category_job_id;
            $jobDetail->jobType_id = $request->type_job_id;
            $jobDetail->responsibility = $request->responsabitilies;
            $jobDetail->qualifications = $request->qualifications;
            $jobDetail->experiences = $request->experiences;
            $jobDetail->company_name = $request->company_name;
            $jobDetail->company_location = $request->company_location;
            $jobDetail->company_website = $request->company_website;
            $jobDetail->save();

            session()->flash('sucess','Job added successfully!');
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

    public function getJob(){

    }
    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
