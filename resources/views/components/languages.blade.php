<li class="dropdown">
    <button class="dropbtn">{{ Config::get('languages')[App::getLocale()] }}</button>
    <div class="dropdown-content">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                    <a href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
            @endif
        @endforeach
    </div>  
</li>