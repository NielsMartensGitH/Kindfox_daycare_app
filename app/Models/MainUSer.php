<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainUser extends Model
{
    use HasFactory;

    public function related_users() {
        return $this->hasManyThrough(MainUser::class, RelationUser::class, 'main_user_id', 'id', 'id', 'related_user_id');
    }
}
