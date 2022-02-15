<header class="post-header">
    <h1 class="box-heading">{{ $title }}</h1>
</header>

<div class="form-group">
    {!! Form::label('title', __('post.title') )!!}
    {!! Form::text('title', null, [
        'class' => 'form-control',
        'placeholder' => __('post.titleHLD'),
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('text', 'Text:' )!!}
    {!! Form::textarea('text', null, [
        'class' => 'form-control',
        'placeholder' => __('post.textHLD'),
        'cols' => 100,
        'rows' => 20,
    ]) !!}
</div>

<div class="form-group group">
    @foreach ($tags as $tag)
        <label class="checkbox">
            {!! Form::checkbox( 'tags[]', $tag->id ) !!}
            {{ $tag->tag }}
        </label>
    @endforeach
</div>

@include('components.or-link')

{!! Form::Button($title, [
    'type' => 'submit',
    'class' => 'btn btn-primary'
]) !!}  