<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobsRequest;
use App\Http\Requests\UpdatejobsRequest;
use App\Mail\JobNotificationEmail;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\TypeJob;
use App\Models\CategoryJob;
use App\Models\User;
use App\Repositories\Interfaces\JobsInterface;
use App\Services\Interfaces\JobsServiceInterface;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{

    public function __construct(protected JobsServiceInterface $service)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->service->index($request);

        // Extract variables from the returned data
        $categories = $data['categories'];
        $types = $data['types'];
        $jobs = $data['jobs'];
        $jobTypeArray = $data['jobTypeArray'];

        // Pass variables to the view
        return view('front.jobs', compact('categories', 'types', 'jobs', 'jobTypeArray'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->service->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobsRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->service->store($request->validated());
    }

    public function getJob()
    {
        return $this->service->getJob();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->service->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobsRequest $request, $id)
    {
       return $this->service->update($request,$id);
    }

    public function destroy($id)
    {

       return $this->service->destroy($id);

    }

    public function applyJob(Request $request) {
        return $this->service->applyJob($request);
    }

    public function saveJob(Request $request){
        return $this->service->saveJob($request);
    }


}
