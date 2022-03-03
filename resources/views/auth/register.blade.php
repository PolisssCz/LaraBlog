<x-guest-layout>
    @section('logo')
        <h1 class="logo">
            <a href="{{route('ghome')}} "><strong>LARA</strong>blog<strong>!&acute;</strong></a>
        </h1>
    @endsection
    @section('content')  
        <form class="box box-auth" method="POST" action="{{ route('register') }}">
            @csrf
            @if ( !Auth::check() )
                <!-- Logo -->
                <h2 class="box-auth-heading">
                    @yield('logo')
                    {{ __('auth.register') }}
                </h2>

                <!-- Name -->
                <input type="text" name="name" placeholder="{{ __('auth.nickname') }}" class="form-control" required autofocus :value="old('name')">

                <!-- Email Address -->
                <x-input placeholder="{{ __('auth.email') }}" class="form-control" type="email" name="email" :value="old('email')" required />

                <!-- Password -->
                <x-input class="form-control"
                placeholder="{{ __('auth.password') }}"
                type="password"
                name="password"
                required autocomplete="new-password" 
                />

                <!-- Confirm Password -->
                <x-input class="form-control"
                placeholder="{{ __('auth.password_again') }}"
                type="password"
                name="password_confirmation" required 
                />

                <x-button class="btn-primary">
                    {{ __('auth.register') }}
                </x-button>
                
                <p class="alt-action">
                {{ __('auth.or') }} <a href=" {{ route('login') }} ">{{ __('auth.sign_up') }}</a>
                </p>                
            @else
                <div class="home-a">
                    <!-- Logo -->
                    @yield('logo')
                    <a class="btn-primary a-home" href="{{ route('home') }}">{{ trans('auth.login') }}</a>
                </div>
            @endif
        </form>
    @endsection
</x-guest-layout>
