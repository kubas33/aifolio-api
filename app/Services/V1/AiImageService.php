<?php

namespace App\Services\V1;

use App\Exceptions\JsonResponseException;
use App\Models\AiImage;
use Exception;
use Illuminate\Support\Facades\Log;
use Str;
use Symfony\Component\HttpFoundation\Response;

class AiImageService
{
    protected AiImageMetaService $aiImageMetaService;

    /**
     * @param AiImageMetaService $aiImageMetaService
     */
    public function __construct(AiImageMetaService $aiImageMetaService)
    {
        $this->aiImageMetaService = $aiImageMetaService;
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
            // Create aiImageMeta
            $meta = $this->aiImageMetaService->create($data['meta']);

            // Create new aiImage
            $aiImage = new AiImage();
            $aiImage->name = $data['name'];
            $aiImage->slug = Str::slug($data['name']);
            $aiImage->model_url = $data['modelUrl'];

            // Save aiImage
            $res = $aiImage->save();

            return $res ? $aiImage : throw new Exception('CANT_STORE_AI_MODEL');
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
            $aiImage->name = $data['name'];
            $aiImage->slug = Str::slug($data['slug']);
            $aiImage->model_url = $data['modelUrl'];

            // Save aiImage
            $res = $aiImage->save();

            return $res ? $aiImage : throw new Exception('CANT_UPDATE_AI_IMAGE');
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
