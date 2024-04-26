<?php

namespace App\Services\Implementations;


use App\Http\Requests\UpdatejobsRequest;
use App\Models\Job;
use App\Models\User;
use App\Repositories\Interfaces\JobsInterface;
use App\Services\Interfaces\JobsServiceInterface;
use Illuminate\Http\Request;

class JobService implements JobsServiceInterface
{

    public function __construct(protected JobsInterface $repository)
    {

    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function create()
    {
        return $this->repository->create();
    }

    public function store(array $jobData)
    {
        return $this->repository->store($jobData);
    }

    public function getJob()
    {
        return $this->repository->getJob();
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    public function update(UpdateJobsRequest $request, $id)
    {
        return $this->repository->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    public function applyJob(Job $job)
    {
        return $this->repository->applyJob($job);
    }

    public function saveJob(Job $job)
    {
        return $this->repository->saveJob($job);
    }
}
