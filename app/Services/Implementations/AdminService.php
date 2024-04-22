<?php

namespace App\Services\Implementations;


use App\Models\Job;
use App\Models\User;
use App\Repositories\Interfaces\AdminInterface;
use App\Services\Interfaces\AdminServiceInterface;

class AdminService implements AdminServiceInterface
{

    public function __construct(protected AdminInterface $repository)
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
