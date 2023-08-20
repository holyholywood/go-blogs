<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\PostCategoryRepository;

class PostCategoryService extends BaseService
{
    public function __construct(PostCategoryRepository $postCategoryRepository)
    {
        parent::__construct($postCategoryRepository);
    }

    public function createPostCategory($post_id, array $categories)
    {

        foreach ($categories as $category_id) {
            $this->repository->create([
                'post_id' => $post_id,
                'category_id' => $category_id
            ]);
        }
    }
}
