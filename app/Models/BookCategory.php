<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookCategory extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'book_categories';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
