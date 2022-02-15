<x-app-layout>
        @section('title', $title)
        @include('components.navigation')
        @section('content')


        <aside class="user-bar author box-edit">
            <a class="avatar-image" href="#"><img src="{{$user->avatar }} " alt="avatar" ></a>
            <ul id="avatar-info">
                <li><a href="#">{{ $user->email }}</a></li>
                <li><a class="{{ URL::current() }}" href="#">{{ $user->rank }} {{ $user->name }}  </a></li>
            </ul>
        </aside>
        <section class="edit-user box">
            
            {!! Form::model($user, ['route' => ['user.update', $user->id ], 'method' => 'put', 'files' => true, 'class' => 'post', 'id' => 'edit-form']) !!}
                    <div class="avatar-image" href="">
                        <!-- Avatar image -->
                        <img src="{{$user->avatar}}" alt="avatar" >
                        <span><span>{{__('post.file')}}</span>
                        {!! Form::file('avatar', null, ['class' => 'form-control',] ) !!}
                    </span> 
                </div>

                    <!-- Email Address -->  
                    {!! Form::email('email', null, [
                        'class' => 'form-control no-drop',
                        'placeholder' => $user->email,
                        'disabled' => 'true',
                    ]) !!}

                    <!-- Name -->                    
                    {!! Form::text('name', null, [
                        'class' => 'form-control',
                        'placeholder' => __('auth.nickname'),
                        'required' => 'true',
                        'autofocus' => 'true',
                    ]) !!}

                    <!-- Password -->
                    {!! Form::password('password', [
                        'class' => 'form-control',
                        'placeholder' =>  __('auth.password') ,
                    ]) !!}

                    <!-- Confirm Password -->
                    {!! Form::password('password_confirmation', [
                        'class' => 'form-control',
                        'placeholder' =>  __('auth.password_again'),
                    ]) !!}

                    <div class="group">
                        <span class="or">
                            {{ __('auth.or') }} {!! link_to('/', __('post.home')) !!}
                        </span>
    
                        <x-button class="btn-primary">
                            {{ __('auth.edit_profil') }}                       
                        </x-button>

                    </div>

                {!! Form::close() !!}
               
            </section>
        @endsection 
</x-app-layout>