<?php

namespace App\Services\Implementations;


use App\Http\Requests\StoreCategoryJobRequest;
use App\Http\Requests\UpdateCategoryJobRequest;
use App\Http\Requests\UpdatejobsRequest;
use App\Models\Admin;
use App\Models\Job;
use App\Models\User;
use App\Repositories\Interfaces\CategoryJobInterface;
use App\Services\Interfaces\CategoryJobServiceInterface;
use Illuminate\Http\Request;

class CategoryJobService implements CategoryJobServiceInterface
{

    public function __construct(protected CategoryJobInterface $repository)
    {

    }

    public function index()
    {
        return $this->repository->index();
    }


    public function store(StoreCategoryJobRequest $request)
    {
        return $this->repository->store($request);
    }


    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    public function update(UpdateCategoryJobRequest $request, $id)
    {
        return $this->repository->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

}
