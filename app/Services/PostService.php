<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\PostRepository;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostService extends BaseService
{
    protected $postCategoryService;
    public function __construct(PostRepository $postRepository, PostCategoryService $postCategoryService)
    {
        parent::__construct($postRepository);

        $this->postCategoryService = $postCategoryService;
    }

    public function createPost(array $data, $with = [])
    {
        DB::beginTransaction();
        try {
            $categories = $data['categories'];

            unset($data['categories']);

            $data['creator_id'] = Auth::id();
            $data['slug'] = $this->setPostSlug($data['title']);
            $data['summary'] = $this->setPostSummary($data['body']);

            $post = $this->create($data, $with);


            $this->postCategoryService->createPostCategory($post->id, $categories);

            DB::commit();

            return $post;
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new Error($th);
        }
    }

    protected function setPostSlug($title)
    {
        if ($title) {
            return Str::slug($title, '-');
        }

        return null;
    }

    protected function setPostSummary($body)
    {
        $plainText = strip_tags(str_replace('<', ' <', $body));
        $plainTextWithSpaces = str_replace('&nbsp;', ' ', $plainText);
        $extractedText = substr($plainTextWithSpaces, 0, 150);

        return $extractedText;
    }
}
