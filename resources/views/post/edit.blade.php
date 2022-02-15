<x-app-layout>
        @include('components.navigation')
        @section('content')

            <section class="box">
                {!! Form::model($post, ['route' => ['post.update', $post->slug ], 'method' => 'put', 'class' => 'post', 'id' => 'edit-form']) !!}

                    {!! Form::hidden('slug', $post->slug) !!}
                    @include('components.form')

                {!! Form::close() !!}
               
            </section>

        @endsection 
</x-app-layout>