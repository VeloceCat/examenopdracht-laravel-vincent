<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Post;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function voteup($id)
    {
        $post= Post::find($id);


    }

    public function votedown($id)
    {
        $post= Post::find($id);

    }

}
