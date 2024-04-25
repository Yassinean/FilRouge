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
        return response()->json(["job"=>$job] , 200);
    }

    public function updateStatusUser(User $user)
    {
        $user->update(['status' => !$user->status]);
        return response()->json(['status' => $user->status],200);
    }
    public function updateStatusFeaturedJob(Job $job)
    {
        $job->update(['isFeatured' => !$job->isFeatured]);
        return redirect()->back()->with('success', 'Job status modified successfully');
    }



}
