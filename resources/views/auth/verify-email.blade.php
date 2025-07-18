{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}


@extends('Backend.backend/auth.app')
@section('main-content') 

<section id="header" class="header">
    <div class="top-bar">
        <div class="container">
            <div class="navigation" id="navigation-scroll">
                    <div class="row">
                        <div class="col-md-11 col-xs-10">
                            <a href="/">
                                <img src="{{ url('assets/img/Logo_1.png') }}" alt="MediKeep Logo" style="width: 80px; height: auto; margin-right: 10px;">
                                <span id="logo"><strong class="strong">M</strong>edi<strong class="strong">K</strong>eep</span>
                            </a>
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
                        <div class="card p-5 " style="border-radius: 15px;">
                            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>
                        
                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif
                        
                            <div class="mt-4 flex mx-auto">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                        
                                    <button type="submit"  class="btn btn-log wow animated fadeInRight">
                                        {{ __('Resend Verification Email') }}      
                                    </button>
                                </form>
                        
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                        
                                    <button type="submit" class="btn btn-out wow animated fadeInRight">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
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
