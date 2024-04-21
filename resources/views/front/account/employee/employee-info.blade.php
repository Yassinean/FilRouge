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
                    <div>
                        <x-message/>
                    </div>
                    <div class="card border-0 shadow mb-4">
                        <form action="{{ route('account.registerData') }}" method="post">
                            @csrf
                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">Mes données</h3>

                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">Education</label>
                                    <textarea style="resize: none" name="education" id="education"
                                              placeholder="Education"
                                              class="form-control">
                                        </textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">Experiences</label>
                                    <textarea style="resize: none" name="experience" id="experience"
                                              placeholder="Experiences"
                                              class="form-control">
                                        </textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">Certifications</label>
                                    <textarea style="resize: none" name="certification" id="certification"
                                              placeholder="Certification"
                                              class="form-control">
                                        </textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">CV</label>
                                    <input type="file" name="cv" id="cv" class="form-control">
                                </div>

                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')

@endsection
