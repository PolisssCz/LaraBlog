<div id="discussion">
    @if ($post->comments)
    <ol class="comments">
        @foreach ($post->comments as $comment)
        @include('components.comment')
        @endforeach
    </ol>        
    @endif
    @if (Auth::check())
    
        {!! Form::open(['route' => 'comment.store', 'method' => 'post', 'class' => 'post' ]) !!}
                {{-- Text field --}}
            {!! Form::textarea('text', null, [
                'placeholder' => __('post.holder_comment') ,
                'class' => 'form-control',
                'rows'  => 3,
            ]) !!}
            
                {{-- Add comment Button --}}
            <div class="form-group">
                {!! Form::hidden('post_id', $post->id) !!}
                {!! Form::Button( __('post.add_coment'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary'
                ]) !!}  
            </div>

        {!! Form::close() !!}
    @else
    {!! Form::open(['route' => 'comment.store', 'method' => 'post', 'class' => 'post' ]) !!}
        {{-- Text field --}}
        {!! Form::textarea('text', null, [
            'placeholder' => __('post.holder_comment_disabled') ,
            'disabled' => true,
            'class' => 'form-control disabled',
            'rows'  => 3,
        ]) !!}
    {!! Form::close() !!}
    @endif
    </div> 