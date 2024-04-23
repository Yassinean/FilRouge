<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreCategoryJobRequest;

use App\Http\Requests\UpdateCategoryJobRequest;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

interface CategoryJobInterface
{
    public function index();

    public function store(StoreCategoryJobRequest $request);

    public function edit($id);
    public function update(UpdateCategoryJobRequest $request, $id);
    public function destroy($id);

}
