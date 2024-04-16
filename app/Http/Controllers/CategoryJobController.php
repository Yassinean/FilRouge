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

}
