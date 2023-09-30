<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\JsonResponseException;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use App\Services\V1\CategoryQueryService;
use App\Services\V1\CategoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;
    protected CategoryQueryService $categoryQueryService;

    public function __construct(CategoryService $categoryService, CategoryQueryService $categoryQueryService) {
        $this->categoryService = $categoryService;
        $this->categoryQueryService = $categoryQueryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = $this->categoryQueryService->query();

        return ResponseHelper::pageResponse($data, CategoryResource::class, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'=> 'required|min:3|unique:categories,name',
        ]);

        $category = $this->categoryService->create($data);
        return ResponseHelper::response(new CategoryResource($category), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        return ResponseHelper::response(new CategoryResource($category), Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'=> ['required','min:3', Rule::unique('categories', 'name')->ignore($category)],
        ]);
        $category = $this->categoryService->update($category, $data);

        return ResponseHelper::response(new CategoryResource($category), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {

        $category = $this->categoryService->delete($category);
        return ResponseHelper::response(new CategoryResource($category), Response::HTTP_OK);

    }
}
