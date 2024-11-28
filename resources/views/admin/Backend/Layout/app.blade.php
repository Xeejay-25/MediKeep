<!DOCTYPE html>
<html lang="en">

    <head>
        @include('Backend.Layout.common-head')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        <!-- DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    </head>

    <body class="g-sidenav-show  bg-gray-100 pt-0">
        


         @include('admin.Backend.Layout.sidebar')
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