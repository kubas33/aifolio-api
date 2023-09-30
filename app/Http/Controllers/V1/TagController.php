<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Http\Resources\V1\TagResource;
use App\Models\Tag;
use App\Services\V1\TagQueryService;
use App\Services\V1\TagService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    protected TagService $tagService;
    protected TagQueryService $tagQueryService;

    public function __construct(TagService $tagService, TagQueryService $tagQueryService)
    {
        $this->tagService = $tagService;
        $this->tagQueryService = $tagQueryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->tagQueryService->query();
        return ResponseHelper::pageResponse($data, Tag::class, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|min:3|unique:tags,name',
        ]);
        $tag = $this->tagService->create($data);
        return ResponseHelper::response(new TagResource($tag), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  Tag  $tag
     * @return JsonResponse
     */
    public function show(Tag $tag): JsonResponse
    {
        return ResponseHelper::response(new TagResource($tag), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Tag  $tag
     * @return JsonResponse
     */
    public function update(Request $request, Tag $tag): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('tags', 'name')->ignore($tag)]
        ]);
        $tag = $this->tagService->update($tag, $data);
        return ResponseHelper::response(new TagResource($tag), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag  $tag
     * @return JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
       $tag = $this->tagService->delete($tag);
       return ResponseHelper::response(new CategoryResource($tag), Response::HTTP_OK);
    }
}
