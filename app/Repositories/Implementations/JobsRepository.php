<?php

namespace App\Repositories\Implementations;

use App\Models\Job;
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

}
