@extends('Backend.backend/auth.app')
@section('main-content') 

<section id="header">
    <div class="top-bar">
        <div class="container">
            <div class="navigation" id="navigation-scroll">
                    <div class="row">
                        <div class="col-md-7 col-xs-10">
                            @include('components.logo')
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.navigation -->
            </div><!--/.container-->
        </div><!--/.top-bar-->

    <div class="container">
        <div class="starting">
            <div class="row">
                <div class="col-md-6">
                    <img src="welcome/invM.png" alt="LUCY" class="wow flipInY animated animated" style="width:70%; margin-top:50px; margin-left:50px; ">
                </div>
                <div class="col-md-4">
                    <div class="banner-text">
                        <!-- Session Status -->
                        <div class="card p-5 shadow-lg" style="border-radius: 15px; background-color: #f9f9f9;">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <h3 class="text-center mb-2">{{ __('Login') }}</h3>

                            <!-- Display Error Messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    
                            <form method="POST" action="{{ route('login') }}" class="login-form">
                                @csrf
                    
                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control mt-1" name="email" :value="old('email')" required autofocus autocomplete="username">
                                </div>
                    
                                <!-- Password -->
                                <div class="form-group mt-4">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control mt-1" name="password" required autocomplete="current-password">
                                </div>
                    
                                <!-- Remember Me -->
                                <div class="form-check mt-4">
                                    <input id="remember_me" type="checkbox" class="form-input" name="remember">
                                    <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                                </div>
                    
                                <!-- Forgot Password & Login Button -->
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="text-sm text-muted text-decoration-underline" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                    
                                    <button type="submit" class="btn btn-primary shadow wow animated fadeInRight">
                                        {{ __('Log in') }}
                                    </button>
                                </div>
                            </form>

                            <!-- Google Sign-In -->
                            <div class="mt-4 text-center">
                                @include('components.google-signin', ['buttonText' => 'Sign in with Google'])
                            </div>
                        </div> 
                    </div> <!-- /.banner-text -->
                </div>
            </div>
        </div>
        <!-- /.starting -->
    </div>
    <!-- /.container -->
</section>
<!-- /#header -->

@endsection
@push('custom-scripts')
@endpush