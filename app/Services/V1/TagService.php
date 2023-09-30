<?php

namespace App\Services\V1;

use App\Exceptions\JsonResponseException;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Log;
use Str;
use Symfony\Component\HttpFoundation\Response;

class TagService
{
    /**
     * Create a new tag.
     *
     * @param array $data
     * @return Tag
     * @throws JsonResponseException
     */
    public function create(array $data): Tag
    {
        try {
            $tag = new Tag();
            $tag->name = $data['name'];
            $tag->slug = Str::slug($data['name']);
            $res = $tag->save();
            return $res ? $tag : throw new Exception('CANT_STORE_TAG');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Cant store tag', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update an existing tag.
     *
     * @param Tag $tag
     * @param array $data
     * @return Tag
     * @throws JsonResponseException
     */
    public function update(Tag $tag, array $data): Tag
    {
        try {
            $tag->name = $data['name'];
            $tag->slug = Str::slug($data['slug']);
            $res = $tag->save();
            return $res ? $tag : throw new Exception('CANT_UPDATE_TAG');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t update tag', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete a tag.
     *
     * @param Tag $tag
     * @return Tag
     * @throws JsonResponseException
     */
    public function delete(Tag $tag): Tag
    {
        try {
            $res = $tag->delete();
            return $res ? $tag : throw new Exception('CANT_DELETE_TAG');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new JsonResponseException('Can\'t delete tag', Response::HTTP_BAD_REQUEST);
        }
    }
}
