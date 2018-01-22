<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'posts';

    protected $casts = ['user_id' => 'integer', 'post_id' => 'integer'];

    protected $fillable = ['comment'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function wasCreatedBy($user) {

        if( is_null($user) ) {
            return false;
        }

        return $this->user_id === $user->id;
    }
}
