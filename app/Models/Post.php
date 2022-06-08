<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'message', 'company_id', 'is_private'
    ];

    public function comments() {
        return $this->hasManyThrough(Comment::class, CommentPost::class, 'post_id', 'id', 'id', 'comment_id');
    }

    public function companies() {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function clients() {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('picture')
            ->acceptsMimeTypes(['image/png'])
            ->singleFile();
    }
}
