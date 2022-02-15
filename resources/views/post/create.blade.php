<x-app-layout>
        @section('title', $title)
        @include('components.navigation')
        @section('content')

            <section class="box">
                
                {!! Form::open([ 'route' => 'post.store', 'method' => 'post', 'class' => 'post', 'id' => 'add-form']) !!}

                 @include('components.form')

                {!! Form::close() !!}
               
            </section>

        @endsection 
</x-app-layout>