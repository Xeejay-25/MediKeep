@extends('admin.Backend.Layout.app')
@section('breadcrumb', 'Users')
@section('title', 'User List')

@section('main-content')
    <div class="container-fluid py-4">
        <hr/>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="titles">
            <div class="tab-titles">
                <p class="tab-links" onclick="opentab('list')">List <span></span></p> 
                <p class="tab-links" onclick="opentab('add')">Add <span></span></p> 
                <p class="tab-links" onclick="opentab('archived')">Archived <span></span></p>                                     
            </div>
        </div>

        <div class="tab-contents active-tab" id="list">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-4">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">User Lists</h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatablesSimpleOne" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($users->count() > 0)
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $user->name }}</td>
                                                        <td class="align-middle">{{ $user->email }}</td>
                                                        <td class="align-middle">
                                                            @if($user->role == \App\Models\User::ROLE_STAFF)
                                                                Staff
                                                            @elseif($user->role == \App\Models\User::ROLE_ADMIN)
                                                                Admin
                                                            @elseif($user->role == \App\Models\User::ROLE_SUPERADMIN)
                                                                Super Admin
                                                            @else
                                                                Unknown
                                                            @endif
                                                        </td>
                                                        <td class="align-middle">{{ ucwords($user->status) }}</td>
                                                        <td class="align-middle">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('users.show', $user->id) }}" type="button" class="btn btn-secondary">
                                                                    <i class="fas fa-info-circle me-1"></i>
                                                                </a>
                                                                <a href="{{ route('users.edit', $user->id) }}" type="button" class="btn btn-warning">
                                                                    <i class="fas fa-edit me-1"></i>
                                                                </a>
                                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline confirmation-form" id="confirmation-form-delete-{{ $user->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger m-0" onclick="confirmAction({{ $user->id }}, 'Are you sure you want to archive this user?', 'delete')">
                                                                        <i class="fas fa-archive me-1"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-center" colspan="6">No users found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-contents" id="add">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-4">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">Add User</h3>
                                </div>

                                <!-- Display Validation Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- User Form -->
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" class="form-control" id="role" required>
                                            <option value="{{ \App\Models\User::ROLE_STAFF }}">Staff</option>
                                            <option value="{{ \App\Models\User::ROLE_ADMIN }}">Admin</option>
                                            <option value="{{ \App\Models\User::ROLE_SUPERADMIN }}">Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status" required>
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="disabled">Disabled</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_verified">Verify Email</label>
                                        <select name="email_verified" id="email_verified" class="form-control">
                                            <option value="0" selected>Not Verified</option>
                                            <option value="1">Verified</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-contents" id="archived">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body p-4">
                                <div class="card-header mb-2 p-2"> 
                                    <h3 class="card-title">Archived Users</h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatablesSimpleTwo" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($archivedUsers->count() > 0)
                                                @foreach($archivedUsers as $user)
                                                    <tr>
                                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $user->name }}</td>
                                                        <td class="align-middle">{{ $user->email }}</td>
                                                        <td class="align-middle">
                                                            @if($user->role == \App\Models\User::ROLE_STAFF)
                                                                Staff
                                                            @elseif($user->role == \App\Models\User::ROLE_ADMIN)
                                                                Admin
                                                            @elseif($user->role == \App\Models\User::ROLE_SUPERADMIN)
                                                                Super Admin
                                                            @else
                                                                Unknown
                                                            @endif
                                                        </td>
                                                        <td class="align-middle">{{ ucwords($user->status) }}</td>
                                                        <td class="align-middle">
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('users.show', $user->id) }}" type="button" class="btn btn-secondary">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </a>

                                                                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline confirmation-form" id="confirmation-form-restore-{{ $user->id }}">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="button" class="btn btn-success m-0" onclick="confirmAction({{ $user->id }}, 'Are you sure you want to restore this user?', 'restore')">
                                                                        <i class="fas fa-undo"></i>
                                                                    </button>
                                                                </form>

                                                                <form action="{{ route('users.destroyForever', $user->id) }}" method="POST" class="d-inline confirmation-form" id="confirmation-form-deleteForever-{{ $user->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger m-0" onclick="confirmAction({{ $user->id }}, 'Are you sure you want to permanently delete this user? This action cannot be undone.', 'deleteForever')">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-center" colspan="6">No archived users found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('custom-scripts')
<script>
    function confirmAction(userId, message, action) {
        if (confirm(message)) {
            document.getElementById('confirmation-form-' + action + '-' + userId).submit();
        }
    }
</script>
@endpush