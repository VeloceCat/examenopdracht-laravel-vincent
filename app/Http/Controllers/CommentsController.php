<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;

class CommentsController extends Controller
{
    public function create(Post $post) 
    {
        $comment = new Comment;

        return view('comments.create')->with(['comment' => $comment, 'post' => $post]);
    }

    public function store(CreateCommentRequest $request, $post_id) 
    {
        $comment = new Comment;

        $post= Post::find($post_id);

        $comment->comment = $request->comment;
        $comment->post()->associate($post);

        $comment->user_id = $request->user()->id;

        $comment->save();

        session()->flash('message', 'Comment Created!');

        return redirect()->route('post_path', [$post->post]);
    }

   
    public function edit(Comment $comment) 
    {
        if($comment->user_id != \Auth::user()->id) {
            return redirect()->route('post_path');
        }

        return view('comments.edit')->with(['comment' => $comment]);
    }

    public function update(Comment $comment, UpdateCommentRequest $request)
    {
        $comment->update(
            $request->only('comment')
        );

        session()->flash('message', 'Comment Updated!');

        return redirect()->route('update_comment_path', ['comment' => $comment->id]);
    }

    public function delete(Comment $comment)
    {
        if($comment->user_id != \Auth::user()->id) {
            return redirect()->route('post_path', ['comment' => $comment->id]);
        }

        $post->delete();

        session()->flash('message', 'Post Deleted!');

        return redirect()->route('posts_path');
    }
}
