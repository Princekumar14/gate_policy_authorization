<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('user')->get();
        // dd($posts);
        return view('policy.index', compact('posts'));
    }
    
    public function show(Post $post){

        $this->authorize('view', $post);

        return view('policy.show')->with('post', $post);
    }
    
    public function destroy(Post $post){

        $this->authorize('delete', $post);

        $post->delete();
        return redirect()->route('post.index');
    }
}
