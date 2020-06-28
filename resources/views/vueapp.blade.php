<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        <title>Laravel</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        {{-- <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /> --}}
        <link href="{{ asset('css/lVidProject.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="fb-root"></div>
        <div id="app">
            <app></app>
        </div>
        <script src="{{ mix('js/vueapp.js') }}" type="text/javascript"></script>
        <script> 
                
                // let elems = document.querySelectorAll('.datepicker') => ({
                //     selectMonths: true, // Creates a dropdown to control month
                //     selectYears: 1, // Creates a dropdown of 15 years to control year
                //     format: "yyyy-mm-dd ",
                //     setDefaultDate: true
                // })
               

        </script>
    </body>
</html>
