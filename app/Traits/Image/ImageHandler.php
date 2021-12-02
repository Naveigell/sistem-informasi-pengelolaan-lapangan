<?php


namespace App\Traits\Image;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageHandler
{
    private function uploadImage(UploadedFile $file)
    {
        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();

        Storage::putFileAs($this->uploadedPath(), $file, $name);

        return $name;
    }

    private function uploadedPath(): string
    {
        return '/public/images/';
    }
}
