<?php

namespace App\Http\Controllers;

use App\Models\Post;  //※モデルの読み込み方が変わった。
use Illuminate\Http\Request;
// use Illuminate\Support\Str;  //※これは何？？

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function list()
    {
        return Post::get();
    }

    public function show(Post $post)
    {
        return view('post.show')->with([
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        // バリデーションは省略してます
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $result = $post->save();

        return ['result' => $result];
    }

    public function update(Request $request, Post $post)
    {
        // バリデーションは省略してます
        $post->title = $request->title;
        $post->description = $request->description;
        $result = $post->save();

        return ['result' => $result];
    }

    public function destroy(Post $post)
    {
        return [
            'result' => $post->delete()
        ];
    }
}
