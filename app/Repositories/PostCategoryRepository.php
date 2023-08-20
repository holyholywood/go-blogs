<?php

namespace App\Repositories;

use App\Models\PostCategory;
use App\Repositories\BaseRepository;

class PostCategoryRepository extends BaseRepository
{
    public function __construct(PostCategory $postCategory)
    {
        parent::__construct($postCategory);
    }
}
