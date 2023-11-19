<?php

namespace App\Services\V1;

use App\Exceptions\JsonResponseException;
use App\Helpers\ImageHelper;
use App\Models\AiImage;
use App\Models\AiImageFilename;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Str;
use Symfony\Component\HttpFoundation\Response;

class AiImageService
{
    protected AiImageMetaService $aiImageMetaService;
    protected AiImageFilenameService $aiImageFilenameService;

    /**
     * @param AiImageMetaService $aiImageMetaService
     */
    public function __construct(AiImageMetaService $aiImageMetaService, AiImageFilenameService $aiImageFilenameService)
    {
        $this->aiImageMetaService = $aiImageMetaService;
        $this->aiImageFilenameService = $aiImageFilenameService;
    }

    /**
     * Create a new aiImage.
     *
     * @param array $data
     * @return AiImage
     * @throws JsonResponseException
     */
    public function create(array $data): AiImage
    {
        try {
            return DB::transaction(function () use ($data) {

                // Create aiImageMeta
                $meta = $this->aiImageMetaService->create($data['meta']);

                // Create new aiImage
                $aiImage = new AiImage();
                $aiImage->user_id = Auth::id();
                $aiImage->image_type = $data['imageType'];
                $aiImage->category_id = $data['categoryId'];
                $aiImage->ai_image_meta_id = $meta->id;

                $fileName = $aiImage->id . "_" . Carbon::now()->timestamp;

                ImageHelper::saveAiImage($data['image'], $aiImage->id, $fileName);
                $aiImage->original_file_name = "$fileName.png";
                // Save aiImage
                $res = $aiImage->save();
                if (!$res) {
                    throw new Exception('CANT_STORE_AI_IMAGE');
                }
                $this->aiImageFilenameService->create($aiImage);
                return $aiImage;
            });
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t store aiImage', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update an existing aiImage.
     *
     * @param AiImage $aiImage
     * @param array $data
     * @return AiImage
     * @throws JsonResponseException
     */
    public function update(AiImage $aiImage, array $data): AiImage
    {
        try {
            // Update aiImage
            return DB::transaction(function () use ($aiImage, $data) {
                $meta = $aiImage->meta;
                $this->aiImageMetaService->update($meta, $data['meta']);
                $aiImage->image_type = $data['imageType'];
                $aiImage->category_id = $data['categoryId'];

                if (isset($data['image'])) {
                    $oldFileName = $aiImage->original_file_name;
                    $fileName = $aiImage->id . "_" . Carbon::now()->timestamp;
                    ImageHelper::saveAiImage($data['image'], $aiImage->id, $fileName);
                    $aiImage->original_file_name = "$fileName.png";
                }
                // Save aiImage
                $res = $aiImage->save();
                if (!$res) {
                    throw new Exception('CANT_STORE_AI_IMAGE');
                }
                $this->aiImageFilenameService->update($aiImage);
                ImageHelper::deleteImage($oldFileName, 'aiImages');
                return $aiImage;
            });
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t update aiImage', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete an aiImage.
     *
     * @param AiImage $aiImage
     * @return AiImage
     * @throws JsonResponseException
     */
    public function delete(AiImage $aiImage): AiImage
    {
        try {
            // Delete aiImage
            $res = $aiImage->delete();
            return $res ? $aiImage : throw new Exception('CANT_DELETE_AI_IMAGE');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t delete aiImage', Response::HTTP_BAD_REQUEST);
        }
    }
}
