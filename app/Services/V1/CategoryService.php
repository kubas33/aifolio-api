<?php

namespace App\Services\V1;

use App\Exceptions\JsonResponseException;
use App\Models\Category;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CategoryService
{
    /**
     * Create a new category.
     *
     * @param  array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        try {
            $category = new Category();
            $category->name = $data['name'];
            $category->slug = Str::slug($data['name']);
            
            $res = $category->save();

            return $res ? $category : throw new Exception('CANT_STORE_CATEGORY');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Cant store category', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update a category.
     *
     * @param  Category $category
     * @param  array $data
     * @return Category
     */
    public function update(Category $category, array $data): Category
    {
        try {
            $category->name = $data['name'];
            $category->slug = Str::slug($data['name']);
            $res = $category->save();

            return $res ? $category : throw new Exception('CANT_UPDATE_CATEGORY');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t update category', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete a category.
     *
     * @param  Category $category
     * @return Category
     */
    public function delete(Category $category): Category
    {
        try {
            $res = $category->delete();

            return $res ? $category : throw new Exception('CANT_DELETE_CATEGORY');

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t delete category', Response::HTTP_BAD_REQUEST);
        }
    }
}
