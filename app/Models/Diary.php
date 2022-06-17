<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_message',
        'food_smile',
        'sleep_message',
        'sleep_smile',
        'poop_icons',
        'mood',
        'activity_message',
        'involvement_message',
        'extra_message',
        'company_id',
        'client_id'
    ];

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
