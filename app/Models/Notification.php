<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['main_user_id', 'company_id', 'model_type', 'model_id'];

    public function main_user() {
        return $this->belongsTo(MainUser::class, 'main_user_id');
    }

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
