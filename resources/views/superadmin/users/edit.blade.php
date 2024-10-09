@extends('superadmin.Backend.Layout.app')
@section('breadcrumb', 'Edit User')
@section('title', 'Edit user')

@section('main-content')
    <div class="container-fluid py-4">
        <hr/>
        
        @include('message')

        <div class="card z-index-2">
            <div class="card-body p-2">
                <div class="card-header mb-2 p-2 d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Edit User</h3>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <small class="form-text text-muted">Leave blank to keep the current password.</small>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role" required>
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Staff</option>
                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
                            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Super Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $user->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="rejected" {{ $user->status == 'disabled' ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>
    </div>
@endsection