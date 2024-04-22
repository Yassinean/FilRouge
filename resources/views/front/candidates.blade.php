@extends('front.layouts.app')

@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Employees</h2>
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

            <div class="col-md-10 col-lg-12 mt-4">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @forelse($employees as $employee)
                                <div class="col-md-3">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <!-- Candidate Image -->
                                            <div class="d-flex justify-content-center candidate-image">
                                                <img src="{{ Storage::url('profile_images/' . $employee->user->image) }}" alt="{{$employee->image}}"
                                                     class="w-50 rounded-circle">
                                            </div>
                                            <!-- Candidate Name -->
                                            <h3 class="border-0 fs-5 pb-2 mt-2 mb-0 text-center">{{$employee->name}}</h3>
                                            <!-- Additional Info -->
                                            <div class="bg-light p-3 border">
                                                <!-- Candidate Description -->
                                                <p class="text-start">{{$employee->designation}}</p>
                                                <!-- Candidate Location -->
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-mobile"></i></span>
                                                    <span class="ps-1">{{$employee->mobile}}</span>
                                                </p>
                                            </div>
                                            <!-- Button to View Candidate Details -->
                                            <div class="d-grid mt-3">
                                                <a href="{{route('profileCandidate',$employee->id)}}" class="btn btn-primary btn-lg">View Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>There is no candidates</p>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

@endsection

@section('customJs')
    <script>
        $('#searchForm').submit(function (e) {
            e.preventDefault();
            let url = '{{route('jobs-page')}}?';
            let keyword = $('#keyword').val();
            let location = $('#location').val();
            let category = $('#category').val();
            //console.log(location)
            if (keyword != '') {
                url += '&keyword=' + keyword;
            }
            if (location != '') {
                url += '&location=' + location;
            }
            if (category != '') {
                url += '&category=' + category;
            }
            window.location.href = {{url()->current()}};
        })
    </script>
@endsection
