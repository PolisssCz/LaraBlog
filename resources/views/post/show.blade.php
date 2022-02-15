<x-app-layout>  
    @include('components.navigation')
    @section('content')
        <section class="box">

            {{-- flash message --}}
            @include('popWindows.alert')

            <article class="post full-post">
                <div class="post-head">
                    <h1>
                        <a href="{{ URL::current() }}">{{ $post->title }}</a>
                    </h1>
                    <time datatime="{{ $post->updated_at }}"><small>{{ $post->created_at }}</small></time>

                    @can('edit-post', $post)
                        <a href="{{ route('post.delete', $post->slug ) }}"><small>X</small></a>
                        <a href="{{ route('post.edit', $post->slug ) }}">{{ __('post.edit') }}</a>                        
                    @endcan

                </div>
                <div class="show-post-content">
                    <p>{!! $post->text !!}</p>

                    <p class="written-by small">
                        <small>{{ __('post.written_by') }}<a href=" {{ route('user.post', $post->user->email) }} ">{{$post->user->email}}</a></small>
                    </p>

                    <footer class="post-footer">
                        @include('components.tags')
                        @include('components.discussion')
                    </footer>                   
                </div>
            </article>
        </section>
    @endsection

</x-app-layout>