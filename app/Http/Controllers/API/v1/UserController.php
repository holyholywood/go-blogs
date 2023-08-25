<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseAPIController
{
    public function __construct()
    {
        $this->responseMessage = [
            'show' => 'Berhasil',
            'update' => 'Berhasil memperbarui profil',
            'destroy' => 'Berhasil menghapus profil',
        ];

        $this->objectName = 'Profil';
    }

    /**
     * Display the specified resource.
     */
    public function show(UserService $service, $username)
    {
        return $this->sendResponse($service->findProfile($username), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, UserService $service, $user_id)
    {

        return $this->sendResponse($service->update($user_id, $request->validated()), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserService $service)
    {
        //
    }
}
