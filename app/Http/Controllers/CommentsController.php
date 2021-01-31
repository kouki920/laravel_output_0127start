<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\DB;


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

        // $post = Post::findOrFail($request['post_id']);

        // $post->comments()->create($request);


        return redirect()->route('board.show',['id' => $post->id]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // $commentId = Post::with('comments')->find(1);

        DB::transaction(function () use ($post){
            $post->comments()->delete();
        });
        return redirect()->route('board.show',['id' => $post->id]);

    }
}
