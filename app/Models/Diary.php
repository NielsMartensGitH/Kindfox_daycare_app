<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    public function clients() {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function companies() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function comments() {
        return $this->hasManyThrough(Comment::class, CommentPost::class, 'diary_id', 'id', 'id', 'comment_id');
    }
}
