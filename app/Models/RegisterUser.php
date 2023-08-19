<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{
    use HasFactory;

    protected $table = 'register_users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'education',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
