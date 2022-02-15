<x-app-layout> 
        @include('components.navigation')
        @section('content')

            <section class="box">
                {!! Form::model($post, ['route' => ['post.destroy', $post->id ], 'method' => 'delete', 'class' => 'post', 'id' => 'delete-form']) !!}
                  
                    <header class="post-header">
                        <h1 class="box-heading">
                            {{ __('post.sure') }}
                        </h1>
                    </header>
                
                
                    {{-- Post Teaser --}}
                    <blockquote class="form-group">
                        <h3>&ldquo;{{ $post->title }}&ldquo;</h3>
                        <p class="teaser">{{ $post->teaser }}</p>
                    </blockquote>
                    
                    @include('components.or-link')
                    
                    {!! Form::Button(__('post.delete'), [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ]) !!}  

                {!! Form::close() !!}
               
            </section>

        @endsection 
</x-app-layout>