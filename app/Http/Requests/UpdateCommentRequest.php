<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends CreateCommentRequest
{
    public function authorize() {
        return $this->user()->id == $this->post->user_id;
    }
}
