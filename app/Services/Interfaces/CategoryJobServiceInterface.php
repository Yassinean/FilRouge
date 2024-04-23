<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreCategoryJobRequest;
use App\Http\Requests\UpdateCategoryJobRequest;


interface CategoryJobServiceInterface
{
    public function index();

    public function store(StoreCategoryJobRequest $request);

    public function edit($id);
    public function update(UpdateCategoryJobRequest $request, $id);
    public function destroy($id);

}
