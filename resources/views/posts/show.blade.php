@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <h2>{{ $post->title }}</h2>
            <p>{{ $post->description }}</p>
            <p>Posted {{ $post->created_at->diffForHumans() }}</p>

        </div>
    </div>
    <hr>

    @foreach($post->comments as $comment)

        <div class="row">
            <ul class="col-md-12">

                <li>
                    {{ $comment->comment }}

                    @if($comment->wasCreatedBy( Auth::user() ))
                        <small class="pull-right">
                            <a href="{{ route('edit_comment_path', ['comment' => $comment->id]) }}" class="btn btn-info">Edit</a>
                        </small>

                        <small class="pull-right">
                            <form action="{{ route('delete_comment_path', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </small>
                    @endif

                    <hr>

                    <p>Posted {{ $comment->created_at->diffForHumans() }} by <b>{{ $comment->user->name }}</b></p>

                </li>

            </ul>
        </div>

        <hr>

    @endforeach
    <div class="row">
        @if(\Auth::check()) 
            <a href="{{ route('create_comment_path', ['post' => $post->id]) }}" class="btn btn-success">Add Comment</a>
        @else
            <p>You need to be <a href="{{ route('login') }}">logged in</a> to comment</p>
        @endif
    </div>
@stop
