<?php

namespace App\Services\V1;
use App\Exceptions\JsonResponseException;
use App\Helpers\ImageHelper;
use App\Models\AiImage;
use App\Models\AiImageFilename;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AiImageFilenameService
{
    public function create(AiImage $aiImage): AiImageFilename
    {
        try {
            return DB::transaction(function () use ($aiImage) {
                $sizes_array = ['xxl' => 2160, 'lg' => 1080, 'md' => 720, 'sm' => 360];
                foreach ($sizes_array as $size => $width) {
                    $aiImageFilename = new AiImageFilename();
                    $fileName = $aiImage->original_file_name;
                    $aiImageFilename->ai_image_id = $aiImage->id;
                    $aiImageFilename->filename = $size . "_" . "$fileName.webp";
                    $aiImageFilename->img_width = $width;
                    $aiImageFilename->img_height = $width;
                    $res = $aiImageFilename->save();
                    if (!$res) {
                        throw new Exception('CANT_STORE_AI_IMAGE_FILENAME');
                    }
                    return $aiImageFilename;
                }
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new JsonResponseException('CANT_STORE_AI_IMAGE_FILENAME', Response::HTTP_BAD_REQUEST);
        }
    }
    public function update( AiImage $aiImage): AiImageFilename {
        try {
            return DB::transaction(function () use ( $aiImage) {
                $aiImageFilenames = AiImageFilename::where('ai_image_id', $aiImage->id)->get();

                if (!$aiImageFilenames) {
                    throw new Exception('AiImageFilenames not found');
                }
                foreach ($aiImageFilenames as $aiImageFilename) {
                    $oldFileName = $aiImageFilename->filename;
                    $fileName = $aiImage->original_file_name;
                    $fileNameParts = explode('_', $fileName);
                    $prefix = reset($fileNameParts);
                    $aiImageFilename->filename = $prefix . "_" . "$fileName.webp";
                    $res = $aiImageFilename->save();
                    if (!$res) {
                        throw new Exception('CANT_STORE_AI_IMAGE_FILENAME');
                    }
                    ImageHelper::deleteImage($oldFileName, 'aiImages');
                    return $aiImageFilename;
                }
            });
            }catch (Exception $e) {
                Log::error($e->getMessage());
                throw new JsonResponseException('CANT_STORE_AI_IMAGE_FILENAME', Response::HTTP_BAD_REQUEST);
            };
    }
}
