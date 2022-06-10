<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model implements HasMedia
{


    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'vat_number', 'email', 'password', 'street_number', 'country', 'postal_code', 'city', 'phone_number'
    ];

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('company_pic')
            ->acceptsMimeTypes(['image/png'])
            ->singleFile();
    }
}
