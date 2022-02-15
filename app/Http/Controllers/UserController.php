<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AvatarService;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $upload, $avatar;
    /**
    * UserController constructor. 
    **/
    public function __construct( UploadService $upload)
    {
        $this->upload = $upload;
    }
    // displays the user profile according to the requested email
    public function show($email)
    {
        // show extra options instead of displaying the profile as others see it
        if ( $email === Auth::user()->email){
            return redirect()->route('my.posts', "$email");
        }

        $user_id = User::select('id')->where('email', "$email")->first();
        $user = User::findOrFail($user_id)->first();
        $auth_user = Auth::user();

        return view('post.index')         
            ->with('auth_user', $auth_user)
            ->with('user', $user)
            ->with('name', $user->name)
            ->with('email', $user->email)
            ->with('rank', $user->rank) 
            ->with('posts', $user->posts);
    }

    public function showMyProfile($email)
    {
        $user_id = User::select('id')->where('email', "$email")->first();
        $user = User::findOrFail($user_id)->first();

        return view('post.index')            
            ->with('user', $user)
            ->with('name', $user->name)
            ->with('email', $user->email)
            ->with('rank', $user->rank) 
            ->with('posts', $user->posts);
    }
    // edit my profile
    public function edit($email)
    {
        $user_id = User::select('id')->where('email', "$email")->first();
        $user = User::findOrFail($user_id)->first(); 

        
        if (! Gate::allows('is-user', $user)) {
            abort(403);
        }
        
        return view('auth.user-edit')
            ->with('user', $user)
            ->with('title', (__('auth.edit_profil')) );
    }
    // update my profile
    public function update(Request $request, $id)
    {
        // find user
        $user = User::whereId($id)
        ->firstOrFail();

        if (! Gate::allows('is-user', $user)) {
            abort(403);
        }

        //validate form
        $validator = $this->validator( $request->all() ); 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // update user
        $user->name = $request->get('name');

        // change password only if one was entered
        if ( $request->get('password') ) {
            $user->password = bcrypt( $request->get('password') );
        }

        //when the user uploads a file, we save it
        if ($request->file('avatar') && $request->file('avatar')->isValid() ) {
            $file = $this->upload->saveFile($user, $request->file('avatar'));            
        }
        
        $user->save();

        //redirect to my posts
        $request->session()->flash('status', (__('message.update')));
        return redirect()->route('user.edit', $user->email)
            ->with('success', (__('message.update')));
    }

    private function validator(array $data)
    {
        return Validator::make($data , [
            'name' => 'required|max:13',
            'password' => 'confirmed|min:6|nullable',
            'avatar' => 'image|max:2650',
        ]);
    }

}
