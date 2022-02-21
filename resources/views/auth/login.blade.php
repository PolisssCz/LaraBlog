<x-guest-layout>
    @section('logo')
        <h1 class="logo">
            <a href="{{route('ghome')}} "><strong>LARA</strong>blog<strong>!&acute;</strong></a>
        </h1>
    @endsection
@section('content')
    <form class="box box-auth" method="POST" action="{{ route('login') }}">
        @csrf
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
        
        <p class="alt-action">
        {{ trans('auth.or') }} <a href=" {{ route('register') }} ">{{ trans('auth.create_account') }}</a>
        {{ trans('auth.or') }} <a href=" {{ route('ghome') }} ">{{ trans('auth.guest') }}</a>
        </p>
    </form>
@endsection
</x-guest-layout>
