@if ($post->tags)
    <ol class="tags">
        @foreach ($post->tags as $tag)
                <li class="bar-tags">
                    <a href="{{ url('tag', $tag->slug)}}">
                        {{ $tag->tag }}
                    </a>
                </li>
        @endforeach
    </ol>
@endif