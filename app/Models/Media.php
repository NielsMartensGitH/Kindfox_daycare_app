<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    public function posts() {
        return $this->hasManyThrough(Post::class, MediaPost::class, 'post_id', 'id', 'id', 'media_id');
    }
}
