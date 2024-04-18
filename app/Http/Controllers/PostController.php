<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post)
    {
        //getPaginateByLimit()はPost.phpで定義したメソッドです。
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(1)]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
}
?>