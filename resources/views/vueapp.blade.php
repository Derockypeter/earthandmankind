<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.materialdesignicons.com/4.5.95/css/materialdesignicons.min.css" rel="stylesheet">
        
        <title>{{ config('app.name', 'Earth and Mankind') }}</title>


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
        <script src="https://cdn.tiny.cloud/1/6zjol00y8s1o0g0xqwi9t0ahjscqrdzxflgmh4dod1tbc261/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </body>
</html>
