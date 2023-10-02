<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AiImageMetaResource;
use App\Models\AiImageMeta;
use App\Services\V1\AiImageMetaQueryService;
use App\Services\V1\AiImageMetaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AiImageMetaController extends Controller
{
    protected AiImageMetaService $aiImageMetaService;
    protected AiImageMetaQueryService $aiImageMetaQueryService;

    /**
     * AiImageMetaController constructor.
     *
     * @param AiImageMetaService $aiImageMetaService
     * @param AiImageMetaQueryService $aiImageMetaQueryService
     */
    public function __construct(AiImageMetaService $aiImageMetaService, AiImageMetaQueryService $aiImageMetaQueryService)
    {
        $this->aiImageMetaService = $aiImageMetaService;
        $this->aiImageMetaQueryService = $aiImageMetaQueryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->aiImageMetaQueryService->query();
        return ResponseHelper::pageResponse($data, AiImageMetaResource::class, Response::HTTP_OK);
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
            'aiModelId' => 'nullable',
            'aiModelVersion' => 'nullable',
            'aiModelHash' => 'nullable',
            'positivePrompts' => 'nullable',
            'negativePrompts' => 'nullable',
            'steps' => 'nullable',
            'sampler' => 'nullable',
            'cgfScale' => 'nullable',
            'seed' => 'nullable',
            'size' => 'nullable',
        ]);

        $aiImageMeta = $this->aiImageMetaService->create($data);
        return ResponseHelper::response(new AiImageMetaResource($aiImageMeta), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param AiImageMeta $aiImageMeta
     * @return JsonResponse
     */
    public function show(AiImageMeta $aiImageMeta): JsonResponse
    {
        return ResponseHelper::response(new AiImageMetaResource($aiImageMeta), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AiImageMeta $aiImageMeta
     * @return JsonResponse
     */
    public function update(Request $request, AiImageMeta $aiImageMeta): JsonResponse
    {
        $data = $request->validate([
            'aiModelId' => 'nullable',
            'aiModelVersion' => 'nullable',
            'aiModelHash' => 'nullable',
            'positivePrompts' => 'nullable',
            'negativePrompts' => 'nullable',
            'steps' => 'nullable',
            'sampler' => 'nullable',
            'cgfScale' => 'nullable',
            'seed' => 'nullable',
            'size' => 'nullable',
        ]);

        $aiImageMeta = $this->aiImageMetaService->update($aiImageMeta, $data);
        return ResponseHelper::response(new AiImageMetaResource($aiImageMeta), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AiImageMeta $aiImageMeta
     * @return JsonResponse
     */
    public function destroy(AiImageMeta $aiImageMeta): JsonResponse
    {
        $aiImageMeta = $this->aiImageMetaService->delete($aiImageMeta);
        return ResponseHelper::response(new AiImageMetaResource($aiImageMeta), Response::HTTP_OK);
    }
}
