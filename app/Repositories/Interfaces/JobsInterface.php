<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreJobsRequest;
use App\Http\Requests\UpdatejobsRequest;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

interface JobsInterface
{
    public function index(Request $request);

    public function create();

    public function store(array $validatedData);

    public function getJob();
    public function show($id);
    public function edit($id);
    public function update(UpdateJobsRequest $request, $id);
    public function destroy($id);
    public function applyJob(Job $job);
    public function saveJob(Job $job);

}
