<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MediaService
{
    public function uploadFile($media)
    {
        $mediaName = $this->setFileName($media->getClientOriginalExtension());

        $media->storeAs('media', $mediaName);

        return [
            "media_name" => $mediaName,
            "media_path" => URL::to('/media/' . $mediaName)
        ];
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
}
