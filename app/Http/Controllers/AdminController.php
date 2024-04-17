<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreCategoryJobRequest;
use App\Http\Requests\StoreTypeJobRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateCategoryJobRequest;
use App\Http\Requests\UpdateTypeJobRequest;
use App\Models\Admin;
use App\Models\CategoryJob;
use App\Models\Job;
use App\Models\TypeJob;
use App\Models\User;
use App\Repositories\Interfaces\JobsInterface;

class
AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('front.account.admin.gestion-users' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {

    }
        /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin, $id)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }

    public function all(){
        $jobs = $this->repository->all();
        return view('front.account.admin.job-status', compact('jobs'));
    }
    protected $repository;
    public function __construct(JobsInterface $repository)
    {
        $this->repository = $repository;
    }

    public function updateStatus(Job $job){
        $this->repository->updateStatus($job);
        return redirect()->back();
    }

    public function updateStatusUser(User $user){
        $this->repository->updateStatusUser($user);
        return redirect()->back();
    }

}
