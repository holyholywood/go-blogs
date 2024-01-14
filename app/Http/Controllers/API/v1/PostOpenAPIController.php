<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostOpenAPIController extends BaseAPIController
{
    protected $static_username = "ditotisi";
    protected $static_userID = 1;

    public function __construct()
    {
        $this->responseMessage = [
            'index' => 'Berhasil',
            'indexCategory' => 'Berhasil',
            'store' => 'Berhasil menambahkan post',
            'show' => 'Berhasil',
            'me' => 'Berhasil',
            'user' => 'Berhasil',
            'update' => 'Berhasil memperbarui post',
            'destroy' => 'Berhasil menghapus post',
        ];

        $this->objectName = 'Post';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PostService $service)
    {
        return $this->sendResponseW($service->all([], ['creator', 'categories'],  [
            'select' => ['id', 'title', 'creator_id', 'summary', 'slug', 'banner', 'type', 'created_at', 'updated_at'],
            'orderBy' => [
                'field' => 'created_at',
                'sort' => 'desc'
            ]
        ]), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexCategory(CategoryService $service, Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            return $this->sendResponse($service->search('category_name',  $search), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
        }
        return $this->sendResponse($service->all(), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }



    public function me(PostService $service, Request $request)
    {
        return $this->sendResponseWithPagination($service->getByUsername($this->static_username, null, $request->query('limit')), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostService $service)
    {

        return $this->sendResponse($service->createPost($request->validated(), ['creator'], $this->static_userID), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, PostService $service)
    {
        // return $this->sendResponse($service->find(['slug' => $slug], ['categories', 'creator']), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
        return $this->sendResponse($service->findPostBySlug($slug), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $post_id, PostService $service)
    {
        return $this->sendResponse($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $post_id, PostService $service)
    {
        return $this->sendResponse($service->delete(['id' => $post_id, "creator_id" => $this->static_userID]), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }
}
