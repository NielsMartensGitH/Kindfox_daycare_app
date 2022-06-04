<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'street_number', 'country', 'postal_code', 'city', 'phone_number'
    ];

    public function related_users() {
        return $this->hasManyThrough(MainUser::class, RelationUser::class, 'main_user_id', 'id', 'id', 'related_user_id');
    }

    public function companies() {
        return $this->HasManyThrough(Company::class, ClientMainUser::class, 'main_user_id', 'id', 'id', 'company_id');
    }

    public function clients() {
        return $this->hasManyThrough(Client::class, ClientMainUser::class, 'main_user_id', 'id', 'id', 'client_id');
    }
}
