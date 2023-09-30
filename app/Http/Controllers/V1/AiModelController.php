<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AiModelResource;
use App\Models\AiModel;
use App\Services\V1\AiModelQueryService;
use App\Services\V1\AiModelService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AiModelController extends Controller
{
    protected AiModelService $aiModelService;
    protected AiModelQueryService $aiModelQueryService;

    /**
     * Create a new AiModelController instance.
     *
     * @param AiModelService $aiModelService
     * @param AiModelQueryService $aiModelQueryService
     */
    public function __construct(AiModelService $aiModelService, AiModelQueryService $aiModelQueryService)
    {
        $this->aiModelQueryService = $aiModelQueryService;
        $this->aiModelService = $aiModelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->aiModelQueryService->query();
        return ResponseHelper::pageResponse($data, AiModelResource::class, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|min:3|unique:ai_models,name',
            'modelUrl' => 'nullable|string|url'
        ]);

        $aiModel = $this->aiModelService->create($data);
        return ResponseHelper::response(new AiModelResource($aiModel), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param AiModel $aiModel
     * @return JsonResponse
     */
    public function show(AiModel $aiModel): JsonResponse
    {
        return ResponseHelper::response(new AiModelResource($aiModel), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AiModel $aiModel
     * @return JsonResponse
     */
    public function update(Request $request, AiModel $aiModel): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('aiModels', 'name')->ignore($aiModel)],
            'modelUrl' => 'nullable|string|url'
        ]);

        $aiModel = $this->aiModelService->update($aiModel, $data);
        return ResponseHelper::response(new AiModelResource($aiModel), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AiModel $aiModel
     * @return JsonResponse
     */
    public function destroy(AiModel $aiModel): JsonResponse
    {
        $aiModel = $this->aiModelService->delete($aiModel);
        return ResponseHelper::response(new AiModelResource($aiModel), Response::HTTP_OK);
    }
}
