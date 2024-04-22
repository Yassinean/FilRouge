<?php

namespace App\Services\Interfaces;

use App\Http\Requests\UpdatejobsRequest;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Request;

interface JobsServiceInterface
{
    public function index();

    public function create();

    public function store(User $user);

    public function getJob();
    public function show($id);
    public function edit($id);
    public function update(UpdatejobsRequest $request, $id);
    public function destroy($id);
    public function applyJob(Request $request);
    public function saveJob(Request $request);

}
