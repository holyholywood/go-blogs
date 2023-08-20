<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\StoreMediaRequest;
use App\Services\MediaService;

class MediaController extends BaseAPIController
{
    public function store(StoreMediaRequest $request,  MediaService $service)
    {
        return $this->sendResponse($service->uploadFile($request->validated('media')));
    }

    public function destroy(MediaService $service, String $media_name)
    {
        return $this->sendResponse($service->deleteFile($media_name));
    }
}
