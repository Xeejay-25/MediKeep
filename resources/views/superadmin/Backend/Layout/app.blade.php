<!DOCTYPE html>
<html lang="en">

    <head>
        @include('Backend.Layout.common-head')
    </head>
    
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