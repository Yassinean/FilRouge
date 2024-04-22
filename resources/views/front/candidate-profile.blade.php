@extends('front.layouts.app')

@section('main')

    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('candidate')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if($employeeProfile->user !== null && $employeeProfile->user->image !== null)
                                    <img src="{{ Storage::url('profile_images/' . $employeeProfile->user->image) }}" alt="3ak"
                                         class="w-50 rounded-circle">
                                @else
                                    <img src="{{ asset('images/avatar7.png')  }}" alt="3ak"
                                         class="w-50 rounded-circle">
                                @endif
                                <div class="mt-3">
                                    <h4>{{$employeeProfile->user->name}}</h4>
                                    <p class="text-secondary mb-1">{{$employeeProfile->user->designation}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            @if(!empty($employeeProfile->website))
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                        </svg>
                                        Website
                                    </h6>
                                    <span class="text-secondary">{{$employeeProfile->website}}</span>
                                </li>
                            @endif
                            @if(!empty($employeeProfile->github))
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
                                            <path
                                                d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                        </svg>
                                        Github
                                    </h6>
                                    <span class="text-secondary">{{$employeeProfile->github}}</span>
                                </li>
                            @endif
                            @if(!empty($employeeProfile->twitter))
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="feather feather-twitter mr-2 icon-inline text-info">
                                                <path
                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                            </svg>
                                            Twitter
                                        </h6>
                                        <span class="text-secondary">{{$employeeProfile->twitter}}</span>
                                    </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$employeeProfile->user->name}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$employeeProfile->user->email}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{$employeeProfile->user->mobile}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row gutters-sm">
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mt-3"><i class="material-icons text-info mr-2">CV</i></h6>
                                    <img src="{{ Storage::url('cv/' . $employeeProfile->cv) }}" class="w-100" alt="cv">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mt-3"><i class="material-icons text-info mr-2">Educations</i></h6>
                                    <small>{!! nl2br($employeeProfile->educations) !!}</small>
                                    <h6 class="d-flex align-items-center mt-3"><i class="material-icons text-info mr-2">Certifications</i></h6>
                                    <small>{!! nl2br($employeeProfile->certifications) !!}</small>
                                    <h6 class="d-flex align-items-center mt-3"><i class="material-icons text-info mr-2">Experiences</i></h6>
                                    <small>{!! nl2br($employeeProfile->experiences) !!}</small>
                                </div>
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
        function applyJob(id) {
            if (confirm('Are you sure you want to apply on this job ?')) {
                let token = '{{ csrf_token() }}';
                $.ajax({
                    // Set the CSRF token in the request headers
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: '{{route('account.applyJob')}}',
                    type: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function (response) {
                        window.location.href = '{{url()->current()}}';
                    }
                })
            }
        }

        function saveJob(id) {
            let token = '{{ csrf_token() }}';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: '{{ route('account.saveJob') }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        alert(response.message); // Display success message
                        // Refresh the page after successfully saving the job
                    } else {
                        alert(response.message); // Display error message
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while processing your request. Please try again later.');
                }
            });
        }

    </script>
@endsection
