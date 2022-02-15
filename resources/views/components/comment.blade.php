<li id="comment--{{ $comment->id }}" class="comment">
    <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name}}">
    <main>
        <a href="{{route('user.post', $comment->user->email )}}">
            <strong>{{ $comment->user->name }}</strong>
        </a>
        <small>{{ $comment->created_at }}</small>

        <p>
            {{ $comment->text}}
        </p>
    </main>
</li>