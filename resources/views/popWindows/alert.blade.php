{{-- Message --}}
@if (Session::has('register'))
    <div class="alert-home alert-success" role="alert">
        {{ session('register') }} <strong>{{ Auth::user()->name }}</strong>🥳
    </div>
@endif
@if (Session::has('login'))
    <div class="alert-home alert-success" role="alert">
        <p>{{ session('login') }}{{ Auth::user()->rank }}<strong> {{ Auth::user()->name }}!</strong>🙂</p>
    </div>
@endif
@if (Session::has('NotAuthorised'))
<div class="alert alert-limitations" role="alert">
    {{ session('NotAuthorised') }}
</div>
@endif
@if (Session::has('logout'))
    <div class="alert alert-success" role="alert">
        {{ session('logout') }}
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

