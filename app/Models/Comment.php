<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function posts() {
        return $this->hasManyThrough(Post::class, CommentPost::class, 'comment_id', 'id', 'id', 'post_id');
    }

    public function diaries() {
        return $this->hasManyThrough(Diary::class, CommentPost::class, 'comment_id', 'id', 'id', 'diary_id');
    }

    public function main_user() {
        return $this->belongsTo(MainUser::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
