<?php

namespace App\Repositories\Implementations;

use App\Models\Job;
use App\Models\User;
use App\Repositories\Interfaces\AdminInterface;

class AdminRepository implements AdminInterface
{
    public function all()
    {
        return Job::paginate(10);
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
