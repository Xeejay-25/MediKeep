{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('Backend.backend/auth.app')
@section('main-content') 

<section id="header" class="header">
    <div class="top-bar">
        <div class="container">
            <div class="navigation" id="navigation-scroll">
                    <div class="row">
                        @include('components.logo')   
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
                        <!-- Box for the message -->
                        <div class="card p-5 " style="border-radius: 15px;">
                            <div class=" mb-5">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>
                        
                        
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                            <!-- Password Reset Form -->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                        
                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                        
                                <!-- Submit Button -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-log wow animated fadeInRight w-100">
                                        {{ __('Email Password Reset Link') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    
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
    
