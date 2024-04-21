<?php

namespace App\Services\Interfaces;

use App\Models\Job;
use App\Models\User;

interface JobsServiceInterface
{
    public function all();

    public function updateStatus(Job $job);

    public function updateStatusUser(User $user);

    public function updateStatusFeaturedJob(Job $job);
}
