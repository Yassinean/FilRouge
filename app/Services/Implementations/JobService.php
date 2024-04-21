<?php

namespace App\Services\Implementations;


use App\Models\Job;
use App\Models\User;
use App\Repositories\Interfaces\JobsInterface;
use App\Services\Interfaces\JobsServiceInterface;

class JobService implements JobsServiceInterface
{

    public function __construct(protected JobsInterface $repository)
    {

    }

    public function all()
    {
        return $this->repository->all();
    }

    public function updateStatus(Job $job)
    {
        return $this->repository->updateStatus($job);
    }

    public function updateStatusUser(User $user)
    {
        return $this->repository->updateStatusUser($user);
    }

    public function updateStatusFeaturedJob(Job $job)
    {
        return $this->repository->updateStatusFeaturedJob($job);
    }
}
