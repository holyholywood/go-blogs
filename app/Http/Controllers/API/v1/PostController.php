<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseAPIController
{
    public function __construct()
    {
        $this->responseMessage = [
            'index' => 'Berhasil',
            'store' => 'Berhasil menambahkan post',
            'show' => 'Berhasil',
            'me' => 'Berhasil',
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
        return $this->sendResponse($service->all([], ['creator', 'categories'],  [
            'select' => ['id', 'title', 'creator_id', 'summary', 'slug', 'banner', 'type', 'created_at', 'updated_at'],
            'orderBy' => [
                'field' => 'created_at',
                'sort' => 'desc'
            ]
        ]), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    public function me(PostService $service)
    {
        return $this->sendResponse($service->all(['creator_id' => Auth::id()], ['creator', 'categories'],  [
            'select' => ['id', 'title', 'creator_id', 'summary', 'slug', 'banner', 'type', 'created_at', 'updated_at'],
            'orderBy' => [
                'field' => 'created_at',
                'sort' => 'desc'
            ]
        ]), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostService $service)
    {

        return $this->sendResponse($service->createPost($request->validated(), ['creator']), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, PostService $service)
    {
        return $this->sendResponse($service->find(['slug' => $slug], ['categories', 'creator']), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
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
        return $this->sendResponse($service->delete(['id' => $post_id]), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }
}
