<!DOCTYPE html>
<html lang="en">

    <head>
        @include('Backend.Layout.common-head')
    </head>
    
    <body class="g-sidenav-show  bg-gray-100 pt-0">
    
         @include('superadmin.Backend.Layout.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
                @include('Backend.Layout.header')
                

                @section('main-content')
                @show
                @include('Backend.Layout.footer')
        </main>
        @include('Backend.Layout.common-end')
        @stack('custom-scripts')

    
    </body>

</html>