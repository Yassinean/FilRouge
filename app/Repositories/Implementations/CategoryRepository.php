<?php

namespace App\Repositories\Implementations;


use App\Http\Requests\StoreCategoryJobRequest;
use App\Http\Requests\UpdateCategoryJobRequest;
use App\Repositories\Interfaces\CategoryJobInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\CategoryJob;


class CategoryRepository implements CategoryJobInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryJob::where('status', 1)->get();
        return view('front.account.admin.job-category', compact('categories'));
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
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = CategoryJob::where('status', 1)->where('id', $id)->first();
        return view('front.account.admin.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
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
