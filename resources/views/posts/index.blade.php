@extends('layouts.app')

@section('content')

        <div class="panel panel-default">
            <div class="panel-heading">
                Article overview
            </div>
            <div class="panel-content">
                <ul class="article-overview">
                    @foreach($posts as $post)
                        <div class="vote">
                            <form action="{{ route('vote_up_path', ['post' => $post->id]) }}" method="POST" class="form-inline upvote">
                                <input type="hidden" name="_token" value="upvote">

                                <button name="post_id"value="{{ $post->id }}">
                                    <i class="fa fa-btn fa-caret-up" title="upvote"></i>
                                </button>
                            </form>
                            <form action="{{ route('vote_down_path', ['post' => $post->id]) }}" method="POST" class="form-inline downvote">
                                <input type="hidden" name="_token" value="downvote">

                                <button name="post_id"value="{{ $post->id }}">
                                    <i class="fa fa-btn fa-caret-down" title="downvote"></i>
                                </button>
                            </form>
                        </div>
                        <div class="url">
                            <a href="{{ $post->url }}" target="_blank" class="urlTitle">{{ $post->title }}</a>

                            @if($post->wasCreatedBy( Auth::user() ))
                                <small class="pull-right">
                                    <a href="{{ route('edit_post_path', ['post' => $post->id]) }}" class="btn btn-info">Edit</a>
                                </small>
                            @endif
                        </div>
                        <div class="info">
                            <p>{{ $post->votes()->count() }} points | Posted {{ $post->created_at->diffForHumans() }} by <b>{{ $post->user->name }}</b> | <a href="{{ route('post_path', ['post' => $post->id]) }}">{{ $post->comments()->count() }} comments</a></p>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>

    {{ $posts->render() }}

@stop