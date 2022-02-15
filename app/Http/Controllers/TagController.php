<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AvatarService;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function show($slug)
    {
        $showTag = Tag::whereSlug($slug)->firstOrFail();
        $user = Auth::user();
       
        return view('post.index')
            ->with('user', $user)
            ->with('title', $showTag->tag)
            ->with('posts', $showTag->posts)
            ->with('name', "continue");
    }
}
