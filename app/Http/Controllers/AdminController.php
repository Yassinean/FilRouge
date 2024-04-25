<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\CategoryJob;
use App\Models\Emplyee;
use App\Models\Emplyer;
use App\Models\Job;
use App\Models\TypeJob;
use App\Models\User;
use App\Repositories\Interfaces\AdminInterface;
use App\Services\Interfaces\AdminServiceInterface;
use Illuminate\Support\Facades\Auth;

class
AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        $users = User::where('role', '!=', 'admin')->paginate(5);
        return view('front.account.admin.gestion-users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userID = Auth::id();
        $categories = CategoryJob::count();
        $candidats = Emplyee::count();
        $employers = Emplyer::count();
        $jobs = Job::count();
        // $userData = User::where('id', $userID)->first();
        $user = User::findOrFail($userID);

        return view('front.account.admin.dashboard', compact('user', 'categories', 'candidats', 'employers', 'jobs'));
    }


    public function __construct(protected AdminServiceInterface $service)
    {

    }

    public function all()
    {
        $jobs = $this->service->all();
        return view('front.account.admin.job-status', compact('jobs'));
    }

    public function updateStatus(Job $job)
    {
        $this->service->updateStatus($job);
        return response()->json($job);
    }

    public function updateStatusUser(User $user)
    {
      $this->service->updateStatusUser($user);
        return response()->json($user);
    }

    public function updateStatusFeaturedJob(Job $job)
    {
        $this->service->updateStatusFeaturedJob($job);
        return response()->json($job);
    }

}
