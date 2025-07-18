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
                @include('components.welcome-invm-img')
                <div class="col-md-6 col-lg-4">
                    <div class="banner-text">
                        <!-- Registration Form Box -->
                        <div class="card p-5 shadow-lg" style="border-radius: 15px; background-color: #f9f9f9;"> <!-- Card for the form -->
                            <h3 class="text-center mb-2">{{ __('Register') }}</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="form-control mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="form-group mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Actions -->
                                <div class="d-flex justify-content-between mt-4 align-items-center">
                                    <a class="text-sm text-muted" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <button type="submit" class="btn btn-primary shadow wow animated fadeInRight">
                                        {{ __('Register') }}
                                    </button>
                                </div>

                                <!-- Google Sign-In -->
                                <div class="mt-4 text-center" href="{{ route('auth.google.redirect') }}">
                                    @include('components.google-signin', ['buttonText' => 'Register with Google'])
                                </div>
                            </form>
                        </div> <!-- /.card -->
                    </div> <!-- /.banner-text -->
                </div> <!-- /.col-md-6 col-lg-5 -->
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
    