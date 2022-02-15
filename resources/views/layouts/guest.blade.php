<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@include('components.title') / LARAblog!</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montez&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive-Q.css') }}">
    </head>
<body class="{{ Request::segment(1) ?: 'home' }}">

    <header class="container body-header">
        {{-- navigatin n stuff --}}
        @yield('logo')
        {{-- application language --}}
        @include('components.languages');
    </header>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Validation Errors -->
    <x-auth-validation-errors class="errors" :errors="$errors" />

    @include('popWindows.alert')

    <main class="container">
        <aside class="nav-all container">
            <nav class="top">
                @yield('logout')
                @yield('userAvatar')
            </nav>
            <nav class="mid">
                @yield('menuLinks')
            </nav>
            <nav class="bottom">
                @yield('menuLinks')
            </nav>
        </aside>

        <article class="container">
            @yield('content')
        </article>

    </main>
 
    <footer class="container body-footer">
        {{-- copyright n thing --}} 
        @yield('logo')
    </footer>

</body>
</html>