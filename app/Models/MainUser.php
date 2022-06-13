<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MainUser extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'street_number', 'country', 'postal_code', 'city', 'phone_number', 'main_user_code'
    ];

    public function related_users() {
        return $this->hasManyThrough(MainUser::class, RelationUser::class, 'main_user_id', 'id', 'id', 'related_user_id');
    }

    public function companies() {
        return $this->HasManyThrough(Company::class, ClientMainUser::class, 'main_user_id', 'id', 'id', 'company_id')->distinct();
    }

    public function clients() {
        return $this->hasManyThrough(Client::class, ClientMainUser::class, 'main_user_id', 'id', 'id', 'client_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user_pic')
            ->acceptsMimeTypes(['image/png'])
            ->singleFile();
    }
}
