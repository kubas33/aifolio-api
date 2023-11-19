<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


abstract class ImageHelper
{
    private static function saveOriginalImage(UploadedFile|string $image, string $path, string $fileName, string $storageType): bool
    {
        $storage = Storage::disk($storageType);
        $img = Image::make($image);

        // Generate file names
        $originalFileNameWebP = pathinfo($fileName, PATHINFO_FILENAME) . '.webp';
        $originalFileNameJpeg = pathinfo($fileName, PATHINFO_FILENAME) . '.jpeg';

        // Save original images
        $storage->put("$path/$originalFileNameWebP", $img->encode('webp', 100));
        $storage->put("$path/$originalFileNameJpeg", $img->encode('jpeg', 100));

        $img->destroy();

        return true;
    }

    private static function resizeAndSaveImages(UploadedFile|string $image, string $path, string $fileName, array $sizes, string $storageType): bool
    {
        $storage = Storage::disk($storageType);
        $img = Image::make($image);
        $img->backup();

        // Generate file names
        $originalFileNameWebP = pathinfo($fileName, PATHINFO_FILENAME) . '.webp';
        $originalFileNameJpeg = pathinfo($fileName, PATHINFO_FILENAME) . '.jpeg';

        foreach ($sizes as $prefix => $size) {
            $img->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $storage->put("$path/$prefix" . '_' . $originalFileNameWebP, $img->encode('webp', 90));
            $storage->put("$path/$prefix" . '_' . $originalFileNameJpeg, $img->encode('jpeg', 90));
            $img->reset();
        }

        $img->destroy();

        return true;
    }

    public static function saveCategoryImage(UploadedFile|string $image, string $path, string $fileName): bool
    {
        ImageHelper::saveOriginalImage($image, $path, $fileName, 'categoriesImages');
        ImageHelper::resizeAndSaveImages($image, $path, $fileName, ['lg' => 1080, 'md' => 720, 'sm' => 360], 'categoriesImages');
        return true;
    }

    public static function saveAiImage(UploadedFile|string $image, string $path, string $fileName): bool
    {
        ImageHelper::saveOriginalImage($image, $path, $fileName, 'aiImages');
        ImageHelper::resizeAndSaveImages($image, $path, $fileName, ['xxl' => 2160, 'lg' => 1080, 'md' => 720, 'sm' => 360], 'aiImages');
        return true;
    }

    public static function deleteImage(string $fileName, string $storageType): bool
    {
        $storage = Storage::disk($storageType);
        $storage->delete($fileName);
        return true;
    }
}
