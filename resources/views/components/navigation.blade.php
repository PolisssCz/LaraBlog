@section('logo')
    <h1 class="logo">
    <a href="{{route('home')}} "><strong>LARA</strong>blog<strong>!&acute;</strong></a>
    </h1>
@endsection
  
@section('userAvatar')
    <aside class="user-bar">
        @if (isset($auth_user) )
           <a class="avatar-image" href="{{ route('user.edit', Auth::user()->email)}}"><img src="{{$auth_user->avatar}}" alt="avatar" ></a>
        @else            
            <a class="avatar-image" href="{{ route('user.edit', Auth::user()->email)}}"><img src="{{$user->avatar}}" alt="avatar" ></a>
        @endif
        <ul id="avatar-info">
            <li><a href="{{ route('my.posts', Auth::user()->email) }}">{{ Auth::user()->name }}</a></li>
            <li><a class="{{ Auth::user()->rank }}" href="{{ route('user.edit', Auth::user()->email)}}">{{ Auth::user()->rank }}</a></li>
        </ul>
    </aside>
@endsection

@section('logout')
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
        this.closest('form').submit();">{{ __('post.log_out') }}</a>
    </form>
@endsection

@section('menuLinks')
    <nav class="nav-header">
        <ol>            
            @if(Request::segment(1) == 'tag' )<li><h1 class="header-title tag-title">{{$title}}</h1></li>@endif
            
            <li><h1 class="header-title"><a class="all-posts" href="{{ route('home') }}">{{ __('post.all_posts') }}</a></h1> </li>
            <li><h1 class="header-title"><a class="my-posts" href="{{ route('my.posts', Auth::user()->email) }}">{{ __('post.my_posts') }}</a></h1> </li>
            <li><h1 class="header-title"><a class="add-new" href="{{ route('post.create') }}">{{ __('post.add_posts') }}</a></h1> </li>
            <li><h1 class="header-title">@yield('logout')</h1> </li>
        </ol>
    </nav>
    @yield('userAvatar')
@endsection