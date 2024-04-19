@extends('front.layouts.app')

@section('main')

    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('jobs-page')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back
                                    to Jobs</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    @include('front.message')
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">

                                    <div class="jobs_conetent">
                                        <a href="#">
                                            <h4>{{$job->title}}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p><i class="fa fa-map-marker"></i> {{$job->location}}</p>
                                            </div>
                                            <div class="location">
                                                <p><i class="fa fa-clock-o"></i> {{$job->typeJob->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        @if(Auth::check())
                                            <a class="heart_mark" href="" onclick="saveJob({{$job->id}})"> <i
                                                    class="fa fa-heart-o" aria-hidden="true"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <div class="single_wrap">
                                <h4>Job description</h4>
                                <p>{{$job->description}}</p>
                            </div>
                            @if (!empty($job->responsabitilies))
                                <div class="single_wrap">
                                    <h4>Responsibility</h4>
                                    {!! nl2br($job->responsabitilies) !!}
                                </div>
                            @endif
                            @if (!empty($job->qualifications))
                                <div class="single_wrap">
                                    <h4>Qualifications</h4>
                                    {!! nl2br($job->qualifications) !!}
                                </div>
                            @endif
                            <div class="border-bottom"></div>
                            @if(Auth::check())
                                <div class="pt-3 text-end">
                                    <a href="" onclick="applyJob({{$job->id}})" class="btn btn-primary">Apply</a>
                                </div>
                            @else
                                <div class="pt-3 text-end">
                                    <a href="{{route('account.login')}}" class="btn btn-primary">Login to Apply</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card shadow border-0 mt-4">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="jobs_conetent">
                                        <h4>{{$jobApplicants->count()}} Applicants</h4>
                                    </div>
                                </div>
                                <div class="jobs_right"></div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Applied Date</th>
                                </tr>
                                @forelse($jobApplicants as $jobApplicant)

                                    <tr>
                                        <td>{{ $jobApplicant->user->name  }}</td>
                                        <td>{{ $jobApplicant->user->email  }}</td>
                                        <td>{{ $jobApplicant->user->mobile  }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($jobApplicant->applied_date)->format('d M, Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="3">Applicants not found</td>
                                @endforelse

                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summery</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on:
                                        <span>{{\Carbon\Carbon::parse($job->created_at)->format('d M,Y')}}</span></li>
                                    <li>Vacancy: <span>{{$job->vacancy}} Position</span></li>
                                    @if(!empty($job->salary))
                                        <li>Salary: <span>{{$job->salary}} DH</span></li>
                                    @endif
                                    <li>Location: <span>{{$job->location}}</span></li>
                                    <li>Job Nature: <span> {{$job->typeJob->name}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Name: <span>{{$job->company_name}}</span></li>
                                    @if (!empty($job->company_location))
                                        <li>Location: <span>{{$job->company_location}}</span></li>
                                    @endif
                                    @if(!empty($job->company_website))
                                        <li>Webite: <span><a
                                                    href="{{$job->company_website}}">{{$job->company_website}}</a></span>
                                        </li>
                                    @endif
                                </ul>
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
