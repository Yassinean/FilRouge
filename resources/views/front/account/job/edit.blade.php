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
                    <form action="" method="post" name="editJobForm" id="editJobForm">
                        @csrf
                        @method('PATCH')
                        <div class="card border-0 shadow mb-4">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title"
                                               class="form-control" value="{{$jobs->title}}">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category_id" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select class="form-select" name="jobType" id="jobType_id">
                                            <option value="">Select Job Type</option>
                                            @if ($types->isNotEmpty())
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                               name="vacancy" class="form-control" value="{{$jobs->vacancy}}">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary"
                                               class="form-control" value="{{$jobs->salary}}" >
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="location" id="location" name="location"
                                               class="form-control" value="{{$jobs->location}}">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                              placeholder="Description">{{$jobs->description}}</textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="form-control" name="responsibility" id="responsibility" cols="5"
                                              rows="5"
                                              placeholder="Responsibility">{{$jobs->responsabitilies}}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" cols="5"
                                              rows="5"
                                              placeholder="Qualifications">{{$jobs->qualifications}}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Experiences</label>
                                    <select name="experiences" id="experiences" class="form-control">
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

                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords"
                                           class="form-control" value="{{$jobs->keywords}}">
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name"
                                               name="company_name" class="form-control" value="{{$jobs->company_name}}">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="location" name="company_location"
                                               class="form-control" value="{{$jobs->company_location}}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="company_website"
                                           class="form-control" value="{{$jobs->company_website}}">
                                </div>
                            </div>
                            <div class="card-footer p-4">
                            </div>
                                <button type="submit" class="btn btn-primary">Save Job</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#editJobForm').submit(function (event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('jobs.update',$jobs->id) }}",
                    type: 'patch',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.status == true) {
                            // If successful, redirect to the job page
                            window.location.href = "{{ route('account.getJob') }}";
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status == 422) {
                            // Handle validation errors
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function (field, messages) {
                                $("#" + field).addClass('is-invalid');
                                $("#" + field).siblings('p').addClass('invalid-feedback').html(messages[0]);
                            });
                        } else {
                            // Handle other errors
                            console.error('Error:', xhr.responseText);
                        }
                    }
                });
            });
        });
    </script>
@endsection
