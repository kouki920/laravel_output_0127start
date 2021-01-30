<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentsController extends Controller
{
    public function store(Request $request)

    {

        $params = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|max:200',
        ]);

        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);

        return redirect()->route('board.show',['id' => $post->id]);
    }
}
