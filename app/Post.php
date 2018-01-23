<?php

namespace App;

use App\User;
use App\Comment;
use App\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model {
    protected $table = 'posts';

    protected $casts = ['user_id' => 'integer'];

    protected $fillable = ['title', 'description', 'url'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function wasCreatedBy($user) {

        if( is_null($user) ) {
            return false;
        }

        return $this->user_id === $user->id;
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }

}