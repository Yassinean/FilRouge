<?php

namespace App\Http\Controllers;

use App\Models\CategoryJob;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = CategoryJob::where('status',1)->orderBy('name','ASC')->take(8)->get();
        $featureJobs = Job::where('status',1)->orderBy('created_at','DESC')->where('isFeatured',1)->take(6)->get();
        $latestJobs = Job::where('status',1)->orderBy('created_at','DESC')->paginate(9);
        // this method will show us home page
        return view('front.home', compact('categories','featureJobs' , 'latestJobs'));
    }

}
