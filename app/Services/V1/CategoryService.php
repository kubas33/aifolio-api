<?php

namespace App\Services\V1;

use App\Exceptions\JsonResponseException;
use App\Helpers\ImageHelper;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
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
            return DB::transaction(function () use ($data) {
                $category = new Category();
                $img_1 = $data['image_1'];
                $img_2 = $data['image_1'];
                $category->name = $data['name'];
                $slug = $category->slug = Str::slug($data['name']);


                $fileName1 = $category->slug . '_1' . Carbon::now()->timestamp;
                $fileName2 = $category->slug . '_2' . Carbon::now()->timestamp;

                ImageHelper::saveCategoryImage($img_1, $slug, $fileName1);
                ImageHelper::saveCategoryImage($img_2, $slug, $fileName2);
                $category->image_1 = $fileName1;
                $category->image_2 = $fileName2;


                $res = $category->save();

                if (!$res) {
                    throw new Exception('CANT_STORE_CATEGORY');
                }
                return  $category;
            });
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
            if (isset($data['image_1'])) {
                $fileName1 = $category->image_1;
                if (empty($fileName1)) {
                    $fileName1 = $category->slug . '_1' . Carbon::now()->timestamp;
                }
                ImageHelper::saveCategoryImage($data['image_1'], $category->slug, $fileName1);
                $category->image_1 = $fileName1;
            }

            if (isset($data['image_2'])) {
                $fileName2 = $category->image_2;
                if (empty($fileName2)) {
                    $fileName2 = $category->slug . '_2' . Carbon::now()->timestamp;
                }
                ImageHelper::saveCategoryImage($data['image_2'], $category->slug, $fileName2);
                $category->image_2 = $fileName2;
            }
            $res = $category->save();
            if (!$res) {
                throw new Exception('CANT_UPDATE_CATEGORY');
            }
            return $category;
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
