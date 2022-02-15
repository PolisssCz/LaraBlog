<x-app-layout>
    
    @include('components.navigation')
    @section('content')

        {{-- flash message --}}
        @include('popWindows.alert')
        @if (!empty($email) || !empty($user_file))
            @include('components.author')
        @endif


        @forelse ($posts as $post)
            <section id="post-{{ $post->id }}" class="post">
                <header class="post-header">
                    <h2>
                        <a href="{{ route('post.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                        <time datatime="{{ $post->updated_at }}">
                            <small>/&nbsp;{{ $post->created_at }}</small>
                        </time>
                    </h2>
                </header>
                <div class="post-content">
                    <p>
                        {{ $post->teaser }}
                    </p>
                </div>

                @include('components.tags')

                <footer class="post-footer">
                    <a href="{{ route('post.show', $post->slug) }}" class="read-more">{{ __('post.read_more') }}</a>
                    @if ($name === "continue")
                    @else
                        <small class="name-code">{{$name}}</small>
                    @endif
                <footer class="post-footer">
                    
            </section>
        @empty            

        <h1>{{ __('post.nothing') }}</h1>

        @endforelse
    
    @endsection
     
    {{-- render only "All posts" page --}}
    @if ( Request::segment(1) == false)
        @section('render')
            {!! $posts->render() !!}
        @endsection
    @endif

</x-app-layout>