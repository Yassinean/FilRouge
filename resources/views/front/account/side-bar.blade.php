<style>
    /* Remove modal backdrop */
    .modal-backdrop {
        display: none !important;
    }
</style>

<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">

        @if (Auth::user()->image != '')
            <img src="{{ Storage::url('profile_images/' . Auth::user()->image) }}" alt="{{ Auth::user()->image }}"
                 class="rounded-circle img-fluid" style="width: 150px;">
        @else
            <img src="{{ asset('images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid"
                 style="width: 150px;">
        @endif

        <h5 id="user_name" class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change
                Profile Picture
            </button>
        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            @if(Auth::user()->role == 'admin')
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('dash.dashboard') }}">Dashboard</a>
                </li>
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('account.profile') }}">Account Settings</a>
                </li>
            @else
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{ route('account.profile') }}">Account Settings</a>
                </li>
            @endif
            @if(Auth::user()->role == 'employer')
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('jobs.create') }}">Post a Job</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('account.getJob') }}">My Jobs</a>
                </li>
            @elseif(Auth::user()->role == 'employee' )
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('account.info')}}">Mes infos</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('account.appliedJob')}}">Jobs Applied</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('account.savedJob')}}">Saved Jobs</a>
                </li>
            @else
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('category-jobs.index')}}">Gestion des categories</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('dash.type')}}">Gestion des types de job</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('dash.allJobs')}}">Gestion des Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('dash.users')}}">Gestion des Users</a>
                </li>
            @endif
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.logout') }}">Logout</a>
            </li>
        </ul>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profilePicForm" name="profilePicForm" action="{{route('account.updateProfilePic')}}"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <p class="text-danger" id="image-error"></p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" id="submit_button" class="btn btn-primary mx-3">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Listen for the modal hidden event
    $('#exampleModal').on('hidden.bs.modal', function (e) {
        // Remove the modal backdrop
        $('.modal-backdrop').remove();
    });
</script>


<script src="{{ asset('assets/js/edit_pic.js') }}"></script>
