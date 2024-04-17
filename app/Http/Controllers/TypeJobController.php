<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeJobRequest;
use App\Http\Requests\UpdateTypeJobRequest;
use App\Models\TypeJob;

class TypeJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function displayTypes()
    {
        $types = TypeJob::where('status', 1)->get();
        return view('front.account.admin.job-type', compact('types'));
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
    public function store(StoreTypeJobRequest $request)
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
    public function show(TypeJob $typeJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $type = TypeJob::where('status', 1)->where('id', $id)->first();
        return view('front.account.admin.edit-type', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeJobRequest $request, $id)
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
    public function destroy($id)
    {
        $categories = TypeJob::findOrFail($id);
        $categories->delete();
        return back()->with('success', 'Type deleted successfully ');
    }
}
