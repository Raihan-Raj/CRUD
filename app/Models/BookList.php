<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookList extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'book_lists';


    protected $fillable = [
        'name',
        'author_id',
        'category_id',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function bookcategory(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class, 'category_id', 'id');
    }
}
