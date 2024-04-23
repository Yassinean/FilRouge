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
                    <x-message/>
                    <div class="card border-0 shadow mb-4">
                        @foreach($employees as $employee)
                            <form action="{{route('account.registerData',$employee->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="card-body p-4">
                                    <h3 class="fs-4 mb-1">Mes données</h3>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2">Education</label>
                                        <textarea name="education" id="education" placeholder="Education" cols="5"
                                                  style="height: 119px;" rows="5"
                                                  class="form-control">{{$employee->educations}}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2">Experiences</label>
                                        <textarea name="experience" id="experience" style="height: 119px;"
                                                  placeholder="Experiences" cols="5" rows="5"
                                                  class="form-control">{{$employee->experiences}}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2">Certifications</label>
                                        <textarea name="certification" id="certification" style="height: 119px;"
                                                  placeholder="Certification" cols="5" rows="5"
                                                  class="form-control">{{$employee->certifications}}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2">Website</label>
                                        <input name="website" id="website" placeholder="Website" class="form-control"
                                               value="{{$employee->website}}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2">GitHub</label>
                                        <input name="github" id="github" placeholder="GitHub" class="form-control"
                                               value="{{$employee->github}}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2">Twitter</label>
                                        <input name="twitter" id="twitter" placeholder="Twiiter" class="form-control"
                                               value="{{$employee->twitter}}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="mb-2">CV (should be an image)</label>
                                        <input type="file" name="cv" id="cv" class="form-control">
                                    </div>
                                    <div class="card-footer p-4">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')

@endsection
