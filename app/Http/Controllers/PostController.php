<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\File;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;

use App\Services\AvatarService;
use App\Components\FlashMessages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SavePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // display only 15 posts on one subpage and create a link with the correct title
        $posts = Post::latest('created_at')->paginate(
            $perPage = 15, $columns = ['*'], $pageName = (__('message.page_name'))
        );

        return view('post.index')            
            ->with('user', $user)
            ->with('posts', $posts)
            ->with('name', "continue");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $user = Auth::user();
        return view('post.create')           
            ->with('user', $user) 
            ->with('title', (__('message.add_new'))); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePostRequest $request)
    {   
        $user = Auth::user();
        //save post to DB
        $post = $user->posts()->create( $request->all() );

        // save post tag to DB
        if( !empty($tags = $request->get('tags')) ){

            foreach ($tags as  $tag) {
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $tag
                ]);
            }
        }
        //redirect to my posts
        return redirect()->route('my.posts', Auth::user()->email) 
            ->with('success', (__('message.yay')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {  
        $user = Auth::user();
        $post = Post::whereSlug($slug)
        ->firstOrFail();

        return view('post.show')            
            ->with('user', $user)
            ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::whereSlug($slug)
        ->firstOrFail();
        // see if the user can edit the post
        if (! Gate::allows('edit-post', $post)) {
            abort(403);
        }

        $user = Auth::user();
     
        return view('post.edit')            
            ->with('title', (__('message.edit_post')))
            ->with('user', $user)
            ->with('post', $post);
    }

    /**
     * Show the form for removing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($slug)
    {
        $post = Post::whereSlug($slug)
        ->firstOrFail(); 
        // see if the user can edit the post
        if (! Gate::allows('edit-post', $post)) {
            abort(403);
        }

        $user = Auth::user();       
      
        return view('post.delete')            
            ->with('title', (__('post.delete')))
            ->with('user', $user)
            ->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(SavePostRequest $request)
    {
        // find post
        $post = Post::whereSlug($request->slug)
        ->firstOrFail();
        // see if the user can edit the post
        if (! Gate::allows('edit-post', $post)) {
            abort(403);
        }

        // update post
        $post->update($request->all());

        // attach tags
        $post->tags()->sync( $request->get('tags') ?: []);

        //redirect to my posts
        return redirect()->route('post.show', $post->slug)
            ->with('success', (__('message.update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        // see if the user can edit the post
        if (! Gate::allows('edit-post', $post)) {
            abort(403);
        }
        
        $post->delete();

        return redirect()->route('home')->with('success', (__('message.is_delete')));
    }
}
