<?php

namespace App\Services\V1;

use App\Exceptions\JsonResponseException;
use App\Models\AiModel;
use Exception;
use Illuminate\Support\Facades\Log;
use Str;
use Symfony\Component\HttpFoundation\Response;

class AiModelService
{
    /**
     * Create a new aiModel.
     *
     * @param array $data
     * @return AiModel
     * @throws JsonResponseException
     */
    public function create(array $data): AiModel
    {
        try {
            $aiModel = new AiModel();
            $aiModel->name = $data['name'];
            $aiModel->slug = Str::slug($data['name']);
            $aiModel->model_url = $data['modelUrl'];
            $res = $aiModel->save();
            return $res ? $aiModel : throw new Exception('CANT_STORE_AI_MODEL');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t store aiModel', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update an existing aiModel.
     *
     * @param AiModel $aiModel
     * @param array $data
     * @return AiModel
     * @throws JsonResponseException
     */
    public function update(AiModel $aiModel, array $data): AiModel
    {
        try {
            $aiModel->name = $data['name'];
            $aiModel->slug = Str::slug($data['slug']);
            $aiModel->model_url = $data['modelUrl'];
            $res = $aiModel->save();
            return $res ? $aiModel : throw new Exception('CANT_UPDATE_aiModel');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t update aiModel', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete an aiModel.
     *
     * @param AiModel $aiModel
     * @return AiModel
     * @throws JsonResponseException
     */
    public function delete(AiModel $aiModel): AiModel
    {
        try {
            $res = $aiModel->delete();
            return $res ? $aiModel : throw new Exception('CANT_DELETE_aiModel');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t delete aiModel', Response::HTTP_BAD_REQUEST);
        }
    }
}
