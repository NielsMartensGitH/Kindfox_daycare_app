<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientMainUser extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'main_user_id', 'company_id', ''];
}
