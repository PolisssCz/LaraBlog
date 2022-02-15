
@if (!empty($auth_user))
    <aside class="user-bar author">
        <a class="avatar-image" href=""><img src="{{$user->avatar}}" alt="avatar" ></a>
        <ul id="avatar-info">
            <li><a href="mailto:{{ $email }}">{{ $email }}</a></li>
            <li><a class="{{ URL::current() }}" href="">{{ $rank }} {{ $name }}  </a></li>
        </ul>
    </aside>
@else
    <aside class="user-bar author">
        <a class="avatar-image" href="{{ route('user.edit', Auth::user()->email)}}"><img src="{{$user->avatar}}" alt="avatar" ></a>
        <ul id="avatar-info">
            <li><a href="#">{{ $email }}</a></li>
            <li><a class="{{ URL::current() }}" href="{{ route('user.edit', Auth::user()->email)}}">{{ $rank }} {{ $name }}  </a></li>
        </ul>
    </aside>

    @if ( $email == $user_email = Auth::user()->email )
        <div class="options">
            <label id="share-profile">
                <h4>{{ __('post.share') }}</h4>
                <input type="text" readonly="readonly" value="{{route('user.post', $user_email )}}"  id="copy-link"> <br>
                <strong onclick="copy()">{{ __('post.copy') }}</strong><span id="copy-success">✔</span>
            </label>
                {{-- application language --}}
                @include('components.languages')    
        </div>
    @endif
@endif