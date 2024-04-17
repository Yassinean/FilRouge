<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryJobRequest;
use App\Http\Requests\UpdateCategoryJobRequest;
use App\Http\Requests;
use App\Models\CategoryJob;
use Illuminate\Http\Request;

class CategoryJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // index >>
    public function displayCategory()
    {
        $categories = CategoryJob::where('status', 1)->get();
        return view('front.account.admin.job-category', compact('categories'));
    }

    public function store(StoreCategoryJobRequest $request)
    {
        $validatedData = $request->validate($request->rules());

        if (!CategoryJob::where('name', $validatedData['category_name'])->exists()) {
            CategoryJob::create([
                'name' => $validatedData['category_name']
            ]);
        } else {
            return redirect()->back()->with('error', 'the category ' . $validatedData['category_name'] . ' already exist');
        }

        return redirect()->back()->with('success', 'You add ' . $validatedData['category_name'] . ' successfully ');
    }

    public function edit(CategoryJob $categoryJob, $id)
    {
        $category = CategoryJob::where('status', 1)->where('id', $id)->first();
        return view('front.account.admin.edit-category', compact('category'));
    }

    public function update(UpdateCategoryJobRequest $request, $id)
    {
        $category = CategoryJob::find($id);


        $validatedData = $request->validate($request->rules());

        $category->name = $validatedData['new_category_name'];
        $category->save();


        return redirect()->back()->with('success', 'The  ' . $validatedData['new_category_name'] . ' updated successfully ');
    }

    public function destroy($id)
    {
        $categories = CategoryJob::findOrFail($id);
        $categories->delete();
        return back()->with('success', 'Category deleted successfully ');
    }

}
