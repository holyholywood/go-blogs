<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\PostRepository;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostService extends BaseService
{
    protected $postCategoryService;
    protected $userService;
    public function __construct(PostRepository $postRepository, PostCategoryService $postCategoryService, UserService $userService)
    {
        parent::__construct($postRepository);

        $this->postCategoryService = $postCategoryService;
        $this->userService = $userService;
    }

    public function findPostBySlug($slug)
    {
        return Cache::remember($slug . "-cache", 30 * 60, function () use ($slug) {

            return $this->find(['slug' => $slug], ['categories', 'creator']);
        });
    }

    public function allData($limit = 10)
    {
        return $this->allPaginate([],  ['creator', 'categories'], [
            'select' => ['id', 'title', 'creator_id', 'summary', 'slug', 'banner', 'type', 'created_at', 'updated_at'],
            'orderBy' => [
                'field' => 'created_at',
                'sort' => 'desc'
            ],
            'limit' => $limit
        ],);
    }

    public function getByUsername($username, $type = null, $limit = 100)
    {
        $user = Cache::remember($username, 60 * 30, function () use ($username) {
            return $this->userService->find(['username' => $username]);
        });

        if (!$user) {
            throw new NotFoundHttpException();
        }

        $result = null;
        switch ($type) {
            case 'poem':
                $result =  $this->allPaginate(['creator_id' => $user->id, 'type' => 'poem'], ['creator', 'categories'],  [
                    'select' => ['id', 'title', 'creator_id', 'summary', 'slug', 'banner', 'type', 'created_at', 'updated_at'],
                    'orderBy' => [
                        'field' => 'created_at',
                        'sort' => 'desc'
                    ],
                    'limit' => $limit
                ]);
                break;
            case 'article':
                $result =   $this->allPaginate(['creator_id' => $user->id, 'type' => 'article'], ['creator', 'categories'],  [
                    'select' => ['id', 'title', 'creator_id', 'summary', 'slug', 'banner', 'type', 'created_at', 'updated_at'],
                    'orderBy' => [
                        'field' => 'created_at',
                        'sort' => 'desc'
                    ],
                    'limit' => $limit
                ]);
                break;
            default:
                $result = Cache::remember("user-posts-" . $limit . $username, 60 * 30,  function () use ($user, $limit) {
                    return    $this->allPaginate(['creator_id' => $user->id], ['creator', 'categories'],  [
                        'select' => ['id', 'title', 'creator_id', 'summary', 'slug', 'banner', 'type', 'created_at', 'updated_at'],
                        'orderBy' => [
                            'field' => 'created_at',
                            'sort' => 'desc'
                        ],
                        'limit' => $limit
                    ]);
                });

                break;
        }



        return $result;
    }

    public function createPost(array $data, $with = [], $id = null)
    {
        DB::beginTransaction();
        try {
            $categories = $data['categories'];

            unset($data['categories']);

            $data['creator_id'] = $id ? $id :  Auth::id();
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
