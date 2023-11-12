<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AiImageResource;
use App\Models\AiImage;
use App\Services\V1\AiImageService;
use App\Services\V1\AiImageQueryService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AiImageController extends Controller
{
    protected AiImageService $aiImageService;
    protected AiImageQueryService $aiImageQueryService;

    /**
     * AiImageController constructor.
     *
     * @param AiImageService $aiImageService
     * @param AiImageQueryService $aiImageQueryService
     */
    public function __construct(AiImageService $aiImageService, AiImageQueryService $aiImageQueryService)
    {
        $this->aiImageService = $aiImageService;
        $this->aiImageQueryService = $aiImageQueryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->aiImageQueryService->query();
        return ResponseHelper::pageResponse($data, AiImageResource::class, Response::HTTP_OK);
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'imageType' => 'required',
            'categoryId' => 'required',
            'meta' => 'required|array',
            'meta.aiModelId' => 'nullable',
            'meta.aiModelVersion' => 'nullable',
            'meta.aiModelHash' => 'nullable',
            'meta.positivePrompts' => 'nullable',
            'meta.negativePrompts' => 'nullable',
            'meta.steps' => 'nullable',
            'meta.sampler' => 'nullable',
            'meta.cgfScale' => 'nullable',
            'meta.seed' => 'nullable',
            'meta.size' => 'nullable',
        ]);

        $aiImage = $this->aiImageService->create($data);
        return ResponseHelper::response(new AiImageResource($aiImage), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param AiImage $aiImage
     * @return JsonResponse
     */
    public function show(AiImage $aiImage): JsonResponse
    {
        return ResponseHelper::response(new AiImageResource($aiImage), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AiImage $aiImage
     * @return JsonResponse
     */
    public function update(Request $request, AiImage $aiImage): JsonResponse
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'imageType' => 'required',
            'categoryId' => 'required',
            'meta' => 'required|array',
            'meta.aiModelId' => 'nullable',
            'meta.aiModelVersion' => 'nullable',
            'meta.aiModelHash' => 'nullable',
            'meta.positivePrompts' => 'nullable',
            'meta.negativePrompts' => 'nullable',
            'meta.steps' => 'nullable',
            'meta.sampler' => 'nullable',
            'meta.cgfScale' => 'nullable',
            'meta.seed' => 'nullable',
            'meta.size' => 'nullable',
        ]);

        $aiImage = $this->aiImageService->update($aiImage, $data);
        return ResponseHelper::response(new AiImageResource($aiImage), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AiImage $aiImage
     * @return JsonResponse
     */
    public function destroy(AiImage $aiImage): JsonResponse
    {
        $aiImage = $this->aiImageService->delete($aiImage);
        return ResponseHelper::response(new AiImageResource($aiImage), Response::HTTP_OK);
    }
}
