<?php

namespace App;

use App\User;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
<<<<<<< HEAD
    protected $table = 'votes';

    protected $casts = ['user_id' => 'integer', 'post_id' => 'integer'];

    protected $fillable = ['vote'];

=======
>>>>>>> eea645573ebd7d14c68ca80a5bca4a513b857892
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function wasCreatedBy($user) {

        if( is_null($user) ) {
            return false;
        }

        return $this->user_id === $user->id;
    }
}
