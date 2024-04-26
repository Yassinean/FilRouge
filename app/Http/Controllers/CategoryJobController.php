<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryJobRequest;
use App\Http\Requests\UpdateCategoryJobRequest;
use App\Http\Requests;
use App\Models\CategoryJob;
use App\Services\Interfaces\CategoryJobServiceInterface;
use Illuminate\Http\Request;

class CategoryJobController extends Controller
{

    public function __construct(protected CategoryJobServiceInterface $service)
    {
    }

    // index >>
    public function index()
    {
        return $this->service->index();
    }

    public function store(StoreCategoryJobRequest $request)
    {
        return $this->service->store($request);
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(UpdateCategoryJobRequest $request, $id)
    {
        return $this->service->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

}
