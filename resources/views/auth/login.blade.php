<x-guest-layout>
    @section('logo')
        <h1 class="logo">
            <a href="{{route('ghome')}} "><strong>LARA</strong>blog<strong>!&acute;</strong></a>
        </h1>
    @endsection
@section('content')
    <form class="box box-auth" method="POST" action="{{ route('login') }}">
        @csrf
        @if ( !Auth::check() )
            <!-- Logo -->
            <h2 class="box-auth-heading">
                @yield('logo')
                {{ trans('auth.login') }}
            </h2>

            <!-- Email Address -->
            <x-input placeholder="{{ trans('auth.email') }}" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            
            <!-- Password -->
            <x-input class="form-control"
            placeholder="{{ trans('auth.password') }}"
            type="password"
            name="password"
            required autocomplete="current-password" 
            />
            
            <!-- Remember Me -->
            <label class="checkbox">
                <input type="checkbox" name="remember"  checked >
                <span>{{ trans('auth.remember_me') }}</span>
            </label>
        
        
            <x-button class="btn-primary">
                {{ trans('auth.login') }}
            </x-button>

            <a class="btn-primary g-home" href="{{ route('ghome') }}">{{ trans('auth.continue_guest') }}</a>

            <p class="alt-action">
            {{ trans('auth.or') }} <a href=" {{ route('register') }} ">{{ trans('auth.create_account') }}</a>
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