<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBorrower extends Model
{
    use HasFactory,UsesUuid;

    protected $table = 'book_borrowers';

    protected $fillable = [
        'register_user_id',
        'book_id',
        'assign_date',
        'return_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
