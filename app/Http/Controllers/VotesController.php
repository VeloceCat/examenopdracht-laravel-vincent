<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Post;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function voteup(Request $request, $id)
    {
        $post = Post::find($id);

        $vote = new Vote;

        $vote->vote = $request->vote;
        $vote->post()->associate($post);

        $vote->user_id = $request->user()->id;

        $vote += 1;
        $vote->save();

        session()->flash('message', 'You have upvoted "$post->title"');

        return redirect()->route('vote_up_path', [$post->post]);
    }

    public function votedown(Request $request, $id)
    {
        $post = Post::find($id);

        $vote = new Vote;

        $vote->vote = $request->vote;
        $vote->post()->associate($post);

        $vote->user_id = $request->user()->id;

        $vote -= 1;
        $vote->save();

        session()->flash('message', 'You have upvoted "$post->title"');

        return redirect()->route('vote_down_path', [$post->post]);

}
