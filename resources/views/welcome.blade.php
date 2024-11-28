
@extends('Backend.backend/auth.app')
@section('main-content')   


    <section id="header">
        <div class="top-bar">
            <div class="container">
                <div class="navigation" id="navigation-scroll">
                        <div class="row">
                            <div class="col-md-11 col-xs-10">
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
                    <div class="col-md-6">
                        <div class="banner-text">
                            <h2 class="animation-box wow bounceIn animated"><strong class="strong">One touch for</strong><br>
                                seamless inventory management</h2>
                            <p>
                                MediKeep has simplified medicine inventory management for countless 
                                healthcare providers, ensuring that essential supplies are always 
                                on hand. Join the growing community of users who trust MediKeep to 
                                streamline their operations and enhance patient care. <br > <br>
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('staff/home') }}" class="btn btn-download wow animated fadeInLeft">
                                        <i class="fa fa-android pull-left"></i>
                                        <strong>Staff</strong>
                                    </a>
                                    <a href="{{ url('admin/home') }}" class="btn btn-download wow animated fadeInLeft">
                                        <i class="fa fa-android pull-left"></i>
                                        <strong>Admin</strong>
                                    </a>
                                    <a href="{{ url('superadmin/home') }}" class="btn btn-download wow animated fadeInLeft">
                                        <i class="fa fa-android pull-left"></i>
                                        <strong>Superadmin</strong>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-download wow animated fadeInLeft">
                                        {{-- <i class="fa fa-android pull-left"></i> --}}
                                         <strong>Log in</strong>
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-download wow animated fadeInRight">
                                            {{-- <i class="fa fa-apple pull-left"></i> --}}
                                            <strong>Register</strong>
                                        </a>
                                    @endif
                                @endauth
                            @endif

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
    