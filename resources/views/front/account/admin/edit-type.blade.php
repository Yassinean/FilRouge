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
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="fs-4 mb-1">Gestion des types </h3>
                                </div>
                            </div>


                            <form method="post" action="{{route('type-jobs.update', $type->id)}}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Type Name</label>
                                    <input type="text" class="form-control" id="categoryName"
                                           name="new_type_name" value="{{ old('type_name', $type->name) }}">
                                </div>

                                <button type="submit" class="btn btn-primary">update Type</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        /*function removeJob(id) {
            if (confirm("Are you sure you want to remove?")) {
                $.ajax({
                    url : '{ route("account.removeJob") }}',
                    type: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function(response) {
                        window.location.href='{ url()->current() }}';
                    }
                });
            }
        }*/
        $(document).ready(function () {
            // Show the modal when the "Add Category" button is clicked
            $('#addCategoryBtn').click(function () {
                $('#addCategoryModal').modal('show');
            });

        });

    </script>

@endsection
