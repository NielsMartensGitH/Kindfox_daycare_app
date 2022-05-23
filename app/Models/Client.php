<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'age', 'checked_in'
    ];

    public function main_users() {
        return $this->hasManyThrough(MainUser::class, ClientMainUser::class, 'client_id', 'id', 'id', 'main_user_id');
    }

    public function companies() {
        return $this->hasOneThrough(Company::class, ClientMainUser::class, 'client_id', 'id', 'id', 'company_id');
    }

    public function diaries() {
        return $this->hasMany(Diary::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
