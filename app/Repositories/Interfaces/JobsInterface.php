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

    public function store(StoreJobsRequest $request);

    public function getJob();
    public function show($id);
    public function edit($id);
    public function update(UpdatejobsRequest $request, $id);
    public function destroy($id);
    public function applyJob(Request $request);
    public function saveJob(Request $request);

}
