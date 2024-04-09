@extends('front.layouts.app')

@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="">Latest</option>
                            <option value="">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="" method="post" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <h2>Keywords</h2>
                                <input type="text" name="keyword" placeholder="Keywords" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Location</h2>
                                <input type="text" name="location" placeholder="Location" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Category</h2>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @forelse($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                    @empty
                                        <p>There is no categories</p>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-4">
                                <h2>Job Type</h2>
                                @forelse($types as $type)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input " name="job_type" type="checkbox"
                                               value="{{$type->id}}" id="job-type-{{$type->id}}">
                                        <label class="form-check-label "
                                               for="job-type-{{$type->id}}">{{$type->name}}</label>
                                    </div>
                                @empty
                                    <p>There is no types</p>
                                @endforelse
                            </div>

                            <div class="mb-4">
                                <h2>Experience</h2>
                                <select name="experience" id="experience" class="form-control">
                                    <option value="">Select Experience</option>
                                    <option value="1">1 Year</option>
                                    <option value="2">2 Years</option>
                                    <option value="3">3 Years</option>
                                    <option value="4">4 Years</option>
                                    <option value="5">5 Years</option>
                                    <option value="6">6 Years</option>
                                    <option value="7">7 Years</option>
                                    <option value="8">8 Years</option>
                                    <option value="9">9 Years</option>
                                    <option value="10">10 Years</option>
                                    <option value="10_plus">10+ Years</option>
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @forelse($jobs as $job)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{$job->title}}</h3>
                                                <p>{{ Str::limit($job->description, 15) }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{$job->location}}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{$job->typeJob->name}}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-hashtag"></i></span>
                                                        <span class="ps-1">{{$job->keywords}}</span>
                                                    </p>

                                                    @if(!is_null($job->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{$job->salary}}</span>
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>There is no jobs</p>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
