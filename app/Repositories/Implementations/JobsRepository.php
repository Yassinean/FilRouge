<?php

namespace App\Repositories\Implementations;

use App\Models\Job;
use App\Models\User;
use App\Repositories\Interfaces\JobsInterface;

class JobsRepository implements JobsInterface
{
    public function all()
    {
        return Job::all();
    }

    public function updateStatus(Job $job)
    {
        $job->update(['status' => !$job->status]);
        return redirect()->back()->with('success', 'Job status modified successfully');
    }

    public function updateStatusUser(User $user)
    {
        $user->update(['status' => !$user->status]);
        return redirect()->back()->with('success', 'User status modified successfully');
    }

}
