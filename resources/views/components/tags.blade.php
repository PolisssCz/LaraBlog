@if ($post->tags)
    <ol class="tags">
        @foreach ($post->tags as $tag)
                @if ( !Auth::check() )
                    <span>{{ __('post.g_tags') }}</span>
                @endif 
                <li class="bar-tags">
                    <a href="{{ url('tag', $tag->slug)}}">
                        {{ $tag->tag }}
                    </a>
                </li>
        @endforeach
    </ol>
@endif
