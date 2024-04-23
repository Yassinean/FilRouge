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
        $this->service->index();
    }

    public function store(StoreCategoryJobRequest $request)
    {
        $this->service->store($request);
    }

    public function edit($id)
    {
        $this->service->edit();
    }

    public function update(UpdateCategoryJobRequest $request, $id)
    {
        $this->service->update($request,$id);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
    }

}
