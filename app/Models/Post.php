<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function comments() {
        return $this->hasManyThrough(Comment::class, CommentPost::class, 'post_id', 'id', 'id', 'comment_id');
    }

    public function companies() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function clients() {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
