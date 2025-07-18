@extends('admin.Backend.Layout.app')

@section('breadcrumb', 'User Details')
@section('title', 'User Details')

@section('main-content')
    <div class="container-fluid py-4">
        <hr/>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="card z-index-2">
            <div class="card-body p-2">
                <div class="card-header mb-2 p-2 d-flex justify-content-between align-items-center">
                    <h3 class="card-title">User Details</h3>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
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
                        </tr>
                        <tr>
                            <th>Email Verified</th>
                            <td>
                                @if($user->email_verified_at)
                                    Verified
                                @else
                                    Not Verified
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ ucwords($user->status) }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection