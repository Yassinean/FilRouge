<?php

namespace App\Repositories\Implementations;

use App\Models\Job;
use App\Models\User;
use App\Repositories\Interfaces\JobsInterface;

class JobsRepository implements JobsInterface
{
    public function all()
    {
        return Job::where('status',0)->paginate(5);
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
    public function updateStatusFeaturedJob(Job $job)
    {
        $job->update(['isFeatured' => !$job->isFeatured]);
        return redirect()->back()->with('success', 'Job status modified successfully');
    }

}
