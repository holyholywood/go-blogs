<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }
}
