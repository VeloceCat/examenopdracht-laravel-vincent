@extends('layouts.app')

@section('content')

    <div class="breadcrumb">
        <a href="/public">&larr; back to overview</a>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            Article: {{ $post->title }}
        </div>
        <div class="panel-content">
            <div class="vote">
                <form action="/posts/{{ $post->id }}" method="GET" class="form-inline upvote">
                    <input type="hidden" name="_token" value="upvote">

                    <button name="post_id"value="{{ $post->id }}">
                        <i class="fa fa-btn fa-caret-up" title="upvote"></i>
                    </button>
                </form>
                <form action="/posts/{{ $post->id }}" method="GET" class="form-inline downvote">
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
                <p>{{ $post->votes()->count() }} points | posted by <b>{{ $post->user->name }}</b> on {{ $post->created_at }} | {{ $post->comments()->count() }} comments</p>
            </div>
            <div class="description">
                <br>
                <p><b>Description:</b></p>
                {{ $post->description }}
            </div>
        </div>

        <div class="comments">
            <ul>
                @foreach($post->comments as $comment)
                    <li>
                        <div class="comment-body clearfix">
                            <div class="comment-text">
                                {{ $comment->comment }}
                            </div>
                            <div style="margin-right: 40px;">
                                @if($comment->wasCreatedBy( Auth::user() ))
                                    <small class="pull-right">
                                        <a href="{{ route('edit_comment_path', ['comment' => $comment->id]) }}" class="btn btn-info">Edit</a>
                                    </small>

                                    <small class="pull-right" style="margin-right: 10px;">
                                        <form action="{{ route('delete_comment_path', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="comment-info">
                            Posted by <b>{{ $comment->user->name }}</b> on {{ $comment->created_at }}
                        </div>
                    </li>
                @endforeach
            </ul>
            <div style="margin-left: 40px;">
                @if(\Auth::check()) 
                    <a href="{{ route('create_comment_path', ['post' => $post->id]) }}" class="btn btn-success">Add Comment</a>
                @else
                    <p>You need to be <a href="{{ route('login') }}">logged in</a> to comment</p>
                @endif
            </div>
        </div>
    </div>


@stop
