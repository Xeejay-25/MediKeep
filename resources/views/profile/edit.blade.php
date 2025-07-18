@php
    use App\Models\User;

    $layout = 'Backend.Layout.app';

    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === User::ROLE_ADMIN) {
            $layout = 'admin.Backend.Layout.app';
        } elseif ($user->role === User::ROLE_SUPERADMIN) {
            $layout = 'superadmin.Backend.Layout.app';
        } elseif ($user->role === User::ROLE_STAFF) {
            $layout = 'Backend.Layout.app';
        }
    }
@endphp

@extends($layout)

@section('breadcrumb', 'Edit Profile')
@section('title', 'Profile')
@section('main-content')   
    <div class="py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">

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
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.image-user-form')
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
<!-- Add any custom scripts here -->
@endpush