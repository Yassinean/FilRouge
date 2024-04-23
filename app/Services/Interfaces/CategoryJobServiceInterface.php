<?php

namespace App\Services\Interfaces;

use App\Http\Requests\UpdatejobsRequest;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

interface CategoryJobServiceInterface
{
    public function index(Request $request);

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
