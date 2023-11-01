<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseAPIController
{
    public function __construct()
    {
        $this->responseMessage = [
            'show' => 'Berhasil',
            'update' => 'Berhasil memperbarui profil',
            'destroy' => 'Berhasil menghapus profil',
            'deleteProfile' => 'Berhasil menghapus avatar',
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

    public function deleteProfile(UserService $service)
    {
        $user_id = Auth::id();
        return   $this->sendResponse($service->update($user_id, [
            'avatar' =>  null
        ]), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }
}
