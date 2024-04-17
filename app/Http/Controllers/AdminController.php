<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreCategoryJobRequest;
use App\Http\Requests\StoreTypeJobRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateCategoryJobRequest;
use App\Http\Requests\UpdateTypeJobRequest;
use App\Models\Admin;
use App\Models\CategoryJob;
use App\Models\TypeJob;
use App\Models\User;

class
AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('front.account.admin.gestion-users' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCategory(StoreCategoryJobRequest $request)
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
    public function storeType(StoreTypeJobRequest $request)
    {
        $validatedData = $request->validate($request->rules());

        if (!TypeJob::where('name', $validatedData['type_name'])->exists()) {
            TypeJob::create([
                'name' => $validatedData['type_name']
            ]);
        } else {
            return redirect()->back()->with('error', 'the type ' . $validatedData['type_name'] . ' already exist');
        }

        return redirect()->back()->with('success', 'You add ' . $validatedData['type_name'] . ' successfully ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editCategory(CategoryJob $categoryJob, $id)
    {
        $category = CategoryJob::where('status', 1)->where('id', $id)->first();
        return view('front.account.admin.edit-category', compact('category'));
    }
    public function editType(TypeJob $typeJob, $id)
    {
        $type = TypeJob::where('status', 1)->where('id', $id)->first();
        return view('front.account.admin.edit-type', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCategory(UpdateCategoryJobRequest $request, $id)
    {
        $category = CategoryJob::find($id);


        $validatedData = $request->validate($request->rules());

        $category->name = $validatedData['new_category_name'];
        $category->save();


        return redirect()->back()->with('success', 'The  ' . $validatedData['new_category_name'] . ' updated successfully ');
    }

    public function updateType(UpdateTypeJobRequest $request, $id)
    {
        $type = TypeJob::find($id);

        $validatedData = $request->validate($request->rules());

        $type->name = $validatedData['new_type_name'];
        $type->save();


        return redirect()->back()->with('success', 'The  ' . $validatedData['new_type_name'] . ' updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCategory($id)
    {
        $categories = CategoryJob::findOrFail($id);
        $categories->delete();
        return back()->with('success', 'Category deleted successfully ');
    }
    public function destroyType($id)
    {
        $categories = TypeJob::findOrFail($id);
        $categories->delete();
        return back()->with('success', 'Type deleted successfully ');
    }
}
