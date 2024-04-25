    @extends('front.layouts.app')

    @section('main')
        <section class="section-5 bg-2">
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Account Settings</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sticky-top">
                            @include('front.account.side-bar')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        @include('front.message')
                        <div class="card border-0 shadow mb-4 p-3">
                            <div class="card-body card-form">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fs-4 mb-1">List Jobs</h3>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Employers</th>
                                            <th scope="col">Job applied</th>
                                            <th scope="col">Applicant</th>
                                            <th scope="col">Publish</th>
                                            <th scope="col">Feature</th>
                                        </tr>
                                        </thead>
                                        <tbody class="border-0">
                                        {{--@dd($jobApplications);--}}
                                        @forelse($jobs as $job)
                                            <tr class="active">
                                                <td>
                                                    <div class="job-name fw-500">{{$job->title}}</div>
                                                </td>
                                                <td>{{\Carbon\Carbon::parse($job->applied_date)->format('d M,Y')}}</td>
                                                <td>{{$job->applications->count()}}</td>
                                                <td>
                                                    <button data-bs-target="{{$job->id}}" class="btn btn-sm changeStatus {{ $job->status ? 'btn-success' : 'btn-warning' }}">
                                                        {{ $job->status ? 'Published' : 'Pending' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <button data-bs-target="{{$job->id}}" class="btn btn-sm changeFeaturedStatus {{ $job->isFeatured ? 'btn-success' : 'btn-danger' }}">
                                                        {{ $job->isFeatured ? 'Featured' : 'Not Featured' }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            No jobs found
                                        @endforelse
                                        </tbody>

                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{$jobs->links()}}
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
        $(".changeStatus").click(function (e) {
            e.preventDefault();
            var button = $(this);
            var jobId = button.data('bs-target');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/account/updateStatusJob/' + jobId,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                dataType: 'json',
                success: function (result) {
                    if (result.status) {
                        button.removeClass('btn-warning').addClass('btn-success').html('Published');
                    } else {
                        button.removeClass('btn-success').addClass('btn-warning').html('Pending');
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        });
        $(".changeFeaturedStatus").click(function (e) {
            e.preventDefault();
            var button = $(this);
            var jobId = button.data('bs-target');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/account/updateFeatureJob/' + jobId,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                dataType: 'json',
                success: function (result) {
                    if (result.isFeatured) {
                        button.removeClass('btn-danger').addClass('btn-success').html('Featured');
                    } else {
                        button.removeClass('btn-success').addClass('btn-danger').html('Not Featured');
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        });

    </script>

    @endsection
