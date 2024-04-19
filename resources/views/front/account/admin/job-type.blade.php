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
                                <button type="button" id="addCategoryBtn" class="btn btn-primary">Add Type</button>
                                <!-- Modal for adding a new category -->
                                <div class="modal fade" id="addCategoryModal" tabindex="-1"
                                     aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addCategoryModalLabel">Add Type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('type-jobs.store')}}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="categoryName" class="form-label">Type
                                                            Name</label>
                                                        <input type="text" class="form-control" id="categoryName"
                                                               name="type_name">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add Type</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="border-0">
                                    {{--@dd($jobApplications);--}}
                                    @forelse($types as $type)
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{$type->name}}</div>
                                            </td>
                                            <td>
                                                @if($type->status == 1)
                                                    <div class="job-status text-capitalize">Published</div>
                                                @else
                                                    <div class="job-status text-capitalize">Block</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-dots float-end">
                                                    <button href="#" class="btn" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a href="{{route('type-jobs.edit',$type->id)}}" class="dropdown-item">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{route('type-jobs.destroy',$type->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="dropdown-item" type="submit"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i>Remove
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        No type found
                                    @endforelse
                                    </tbody>

                                </table>
                            </div>
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
