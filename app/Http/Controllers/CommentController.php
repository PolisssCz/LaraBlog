<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SaveCommentRequest;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCommentRequest $request)
    {
        $post = Post::findOrFail( $request->get('post_id') );

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'text' => $request->get('text'),
        ]);
        if ( $request->ajax() ) {
            return response()->json([
                'id' => $comment->id,
                'message' => 'welldone',
            ]);
        }

        return redirect()->route('post.show', $post->slug)
            ->with('success', (__('message.is_comment')));
    }

    /**
     * Display the comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        return view('components.comment')
            ->with('comment', $comment);
    }
}
