<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
            
       
        <title>@include('components.title') / LARAblog!</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Montez&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128+Text&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/post.css') }}">
        <link rel="stylesheet" href="{{ asset('css/user.css') }}">
        <link rel="stylesheet" href="{{ asset('css/myPosts.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    </head>

    @include('components.body+class')

        <header class="container app-header">
            {{-- navigatin n stuff --}}
            @yield('logo')
            @yield('menuLinks')
        </header>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth-validation-errors class="errors" :errors="$errors" />
        
        <main class="container">
            <article class="container">
                {{-- MAIN CONTENT --}}
                @yield('content')
            </article>

        </main>
            <div class="render">
                @yield('render')
            </div>   
        <footer class="container body-footer">
            {{-- copyright n thing --}} 
            @yield('logo')
        </footer>

        {{-- javaScript --}}
        <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{ asset('js/app.js')}}"></script>

    </body>
</html>