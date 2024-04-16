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
    public function displayCategory()
    {
        $categories = CategoryJob::where('status', 1)->get();
        return view('front.account.admin.job-category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(CategoryJob $categoryJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryJob $categoryJob)
    {
        $categories = CategoryJob::where('status', 1)->first();
        return view('front.account.admin.edit-category', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryJobRequest $request, CategoryJob $categoryJob)
    {
        $validatedData = $request->validate($request->rules());

        $categoryJob->update([
            'name' => $validatedData['new_category_name']
        ]);

        return redirect()->back()->with('success', 'The  ' . $validatedData['new_category_name'] . ' updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categories = CategoryJob::findOrFail($id);
        $categories->delete();
        return back()->with('success', 'Category deleted successfully ');
    }
}
