<!DOCTYPE html>
<html lang="en">

    <head>
        @include('Backend.backend/auth.common-head')
        <style>
            /* .c {
                height: 200vh;
                width: 960px;
                margin: auto;
                max-width: 95%;

            }

            ::-webkit-scrollbar-track
            {
                border: 5px snow white;
                background-color: gray;
            }

            ::-webkit-scrollbar
            {
                width: 10px;
                background-color: #dfe6e9;
            }

            ::-webkit-scrollbar-thumb
            {
                background-color: #74b9ff;
                border-radius: 10px;
            } */

            body::-webkit-scrollbar {
                width: 0;
            }

            /* body.show-scrollbar::-webkit-scrollbar {
                width: 10px;
            } */
        </style>
    </head>

    <body class="g-sidenav-show  bg-gray-100 pt-0">
        


        <main class="main-content header">

                @section('main-content')
                @show

        </main>
        @include('Backend.backend/auth.common-end')
        @stack('custom-scripts')
    </body>

</html>