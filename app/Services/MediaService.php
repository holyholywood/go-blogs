<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MediaService
{
    public function uploadFile($media)
    {

        return $this->sendToImageService($media);
    }

    public function deleteFile($mediaName)
    {
        $path = 'media/' . $mediaName;
        if (!Storage::exists($path)) {
            throw new NotFoundHttpException('Media tidak Ditemukan');
        }

        $isDeleteSuccess =  Storage::delete($path);
        if (!$isDeleteSuccess) {
            throw new InternalErrorException('Gagal menghapus gambar');
        }

        return "Gambar Berhasil dihapus. Media: " . $mediaName;
    }

    protected function setFileName($extension)
    {
        $date = date('dmY');


        return $date . '-' . str_replace(' ', '_', Auth::user()->name) . '-' .  rand()  . '.' . $extension;
    }

    protected function sendToImageService($file)
    {
        $baseURL = Env("API_IMAGE_SERVICE_URL");
        $url = $baseURL . "/api/upload";
        try {

            $fileName = $this->setFileName($file->getClientOriginalExtension());

            $response = Http::attach("image", file_get_contents($file->getRealPath()), $fileName)->post($url)->body();

            $decoded =  json_decode($response, true);

            return [
                "media_name" => $decoded["fileName"],
                "media_path" => $decoded["url"],
            ];
        } catch (\Throwable $th) {
            throw new InternalErrorException($th->getMessage());
        }
    }
}
