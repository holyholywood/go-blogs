<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseAPIController;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseAPIController
{
    public function __construct()
    {
        $this->responseMessage = [
            'index' => 'Berhasil',
            'store' => 'Berhasil menambahkan kategori',
            'search' => 'Berhasil',
            'show' => 'Berhasil',
            'update' => 'Berhasil memperbarui kategori',
            'destroy' => 'Berhasil menghapus kategori',
        ];

        $this->objectName = 'Kategori';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryService $service, Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            return $this->sendResponse($service->search('category_name',  $search), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
        }
        return $this->sendResponse($service->all(), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CategoryService $service)
    {
        $validatedRequest = $request->validate(['category_name' => 'required|string']);

        return $this->sendResponse($service->create($validatedRequest), JsonResponse::HTTP_CREATED, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category_id, CategoryService $service)
    {
        return $this->sendResponse($service->find(['id' => $category_id]), JsonResponse::HTTP_CREATED, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category_id, CategoryService $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category_id, CategoryService $service)
    {
        return $this->sendResponse($service->delete(['id' => $category_id]), JsonResponse::HTTP_CREATED, $this->responseMessage[__FUNCTION__]);
    }
}
