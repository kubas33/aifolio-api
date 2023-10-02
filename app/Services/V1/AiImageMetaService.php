<?php

namespace App\Services\V1;

use App\Exceptions\JsonResponseException;
use App\Models\AiImageMeta;
use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AiImageMetaService
{
    /**
     * @param array $data
     * @return AiImageMeta
     */
    public function create(array $data): AiImageMeta
    {
        try {
            $aiImageMeta = new AiImageMeta();
            $aiImageMeta->ai_model_id = $data['aiModelId'];
            $aiImageMeta->ai_model_version = $data['aiModelVersion'];
            $aiImageMeta->ai_model_hash = $data['aiModelHash'];
            $aiImageMeta->positive_prompts = $data['positivePrompts'];
            $aiImageMeta->negative_prompts = $data['negativePrompts'];
            $aiImageMeta->steps = $data['steps'];
            $aiImageMeta->sampler = $data['sampler'];
            $aiImageMeta->cgf_scale = $data['cgfScale'];
            $aiImageMeta->seed = $data['seed'];
            $aiImageMeta->size = $data['size'];
            $res = $aiImageMeta->save();
            if (!$res) {
                throw new Exception('CANT_STORE_AI_IMAGE_META');
            }

            return $aiImageMeta;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t save aiImageMeta', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param AiImageMeta $aiImageMeta
     * @param array $data
     * @return AiImageMeta
     */
    public function update(AiImageMeta $aiImageMeta, array $data): AiImageMeta {
        try {
            $aiImageMeta->ai_model_id = $data['aiModelId'];
            $aiImageMeta->ai_model_version = $data['aiModelVersion'];
            $aiImageMeta->ai_model_hash = $data['aiModelHash'];
            $aiImageMeta->positive_prompts = $data['positivePrompts'];
            $aiImageMeta->negative_prompts = $data['negativePrompts'];
            $aiImageMeta->steps = $data['steps'];
            $aiImageMeta->sampler = $data['sampler'];
            $aiImageMeta->cgf_scale = $data['cgfScale'];
            $aiImageMeta->seed = $data['seed'];
            $aiImageMeta->size = $data['size'];
            $res = $aiImageMeta->save();
            if (!$res) {
                throw new Exception('CANT_UPDATE_AI_IMAGE_META');
            }

            return $aiImageMeta;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t update aiImageMeta', Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete(AiImageMeta $aiImageMeta): AiImageMeta {
        try {
            $res = $aiImageMeta->delete();

            if (!$res) {
                throw new Exception('CANT_DELETE_AI_IMAGE_META');
            }

            return $aiImageMeta;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t delete aiImageMeta', Response::HTTP_BAD_REQUEST);
        }
    }
}
