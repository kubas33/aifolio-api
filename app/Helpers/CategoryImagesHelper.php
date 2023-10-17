<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

abstract class CategoryImagesHelper
{
    /**
     * Save category image
     *
     * @param UploadedFile|string $image The image file or file path
     * @param string $path The path to save the image
     * @param string $fileName The name of the image file
     * @return bool Returns true if the image is successfully saved
     */
    public static function saveCategoryImage(UploadedFile|string $image, string $path, string $fileName): bool
    {
        $storage = Storage::disk('categoriesImages');
        $img = Image::make($image);

        // Generate file names
        $originalFileNameWebP = pathinfo($fileName, PATHINFO_FILENAME) . '.webp';
        $originalFileNameJpeg = pathinfo($fileName, PATHINFO_FILENAME) . '.jpeg';

        // Save original images
        $storage->put("$path/$originalFileNameWebP", $img->encode('webp', 90));
        $storage->put("$path/$originalFileNameJpeg", $img->encode('jpeg', 90));

        // Resize and save images with different sizes
        $sizes = [
            'lg' => 1080,
            'md' => 720,
            'sm' => 360,
        ];

        foreach ($sizes as $prefix => $size) {
            $resizedImg = $img->clone();
            $resizedImg->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $storage->put("$path/$prefix" . '_' . $originalFileNameWebP, $resizedImg->encode('webp', 90));
            $storage->put("$path/$prefix" . '_' . $originalFileNameJpeg, $resizedImg->encode('jpeg', 90));
        }

        $img->destroy();

        return true;
    }
}

