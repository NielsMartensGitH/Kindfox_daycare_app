<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function diaries() {
        return $this->hasMany(Diary::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }

    public function main_users() {
        return $this->hasManyThrough(MainUser::class, ClientMainUser::class, 'company_id', 'id', 'id', 'main_user_id');
    }

    public function events() {
        return $this->HasMany(Event::class);
    }
}
