<?php

namespace App\Http\Controllers\Panel;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog as Post;

class BlogController extends Controller
{
    public function show($id)
    {
        $post = Post::find($id);
        return view('panel/blog/show/single')->with(['post'=>$post]);
    }

    public function showAll(Request $request)
    {
        $postsPerpage = 20;
        if($request->per_page) $postsPerpage = $request->per_page;

        $posts = Post::orderBy('date', 'desc')->paginate($postsPerpage);

        return view('panel/blog/show')->with(['posts'=>$posts]);
    }

    public function edit(Request $request)
    {
        $postId = $request->get("id");

        $post = Blog::find($postId);

        foreach($request->post as $key=>$value){
            if($value != null)$post->$key = $value;
        }

        //if($user->ip == null) $user->ip = '127.0.0.1';
        if($post->date == null) $post->date = date('Y-m-d H:i:s');

        $post->save();

        return redirect()->route('panel_blog_single_show', $postId);
    }


}
