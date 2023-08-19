<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'authors';



    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /*  public function books()
    {
        return $this->belongsToMany(BookList::class);
    } */
}
