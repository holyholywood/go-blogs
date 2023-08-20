<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'banner',
        'type',
        'creator_id'
    ];

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(Category::class, PostCategory::class, 'post_id', 'id', 'id', 'category_id');
    }
}
