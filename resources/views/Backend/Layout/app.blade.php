<!DOCTYPE html>
<html lang="en">

    <head>
        @include('Backend.Layout.common-head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="g-sidenav-show  bg-gray-100 pt-0">
        


         @include('Backend.Layout.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
                @include('Backend.Layout.header')

                @section('main-content')
                @show
                @include('Backend.Layout.footer')
        </main>
        @include('Backend.Layout.common-end')
        @stack('custom-scripts')
        @stack('custom-css')

        @stack('custom-scripts')
    @stack('custom-css')

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</html>