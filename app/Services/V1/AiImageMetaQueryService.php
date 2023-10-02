<?php

namespace App\Services\V1;

use App\Models\AiImageMeta;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class AiImageMetaQueryService
{
    /**
     * Get allowed sorts for the query.
     *
     * @return array
     */
    private function getAllowedSorts(): array
    {
        return [
            AllowedSort::field('id', 'id'),
            AllowedSort::field('aiModelId', 'ai_model_id'),
            AllowedSort::field('aiModelVersion', 'ai_model_version'),
            AllowedSort::field('aiModelHash', 'ai_model_hash'),
            AllowedSort::field('positivePrompts', 'positive_prompts'),
            AllowedSort::field('negativePrompts', 'negative_prompts'),
            AllowedSort::field('steps', 'steps'),
            AllowedSort::field('sampler', 'sampler'),
            AllowedSort::field('cgfScale', 'cgf_scale'),
            AllowedSort::field('seed', 'seed'),
            AllowedSort::field('size', 'size'),
            AllowedSort::field('createdAt', 'created_at'),
            AllowedSort::field('updatedAt', 'updated_at'),
            AllowedSort::field('deletedAt', 'deleted_at'),
        ];
    }

    /**
     * Get allowed filters for the query.
     *
     * @return array
     */
    private function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id', 'id'),
            AllowedFilter::exact('aiModelId', 'ai_model_id'),
            AllowedFilter::partial('aiModelVersion', 'ai_model_version'),
            AllowedFilter::partial('aiModelHash', 'ai_model_hash'),
            AllowedFilter::partial('positivePrompts', 'positive_prompts'),
            AllowedFilter::partial('negativePrompts', 'negative_prompts'),
            AllowedFilter::partial('steps', 'steps'),
            AllowedFilter::partial('sampler', 'sampler'),
            AllowedFilter::partial('cgfScale', 'cgf_scale'),
            AllowedFilter::partial('seed', 'seed'),
            AllowedFilter::partial('size', 'size'),
            AllowedFilter::partial('createdAt', 'created_at'),
            AllowedFilter::partial('updatedAt', 'updated_at'),
            AllowedFilter::partial('deletedAt', 'deleted_at'),
        ];
    }

    /**
     * Execute the query and return a paginated result.
     *
     * @return LengthAwarePaginator
     */
    public function query(): LengthAwarePaginator
    {
        return QueryBuilder::for(AiImageMeta::class)
            ->allowedFilters($this->getAllowedFilters())
            ->allowedSorts($this->getAllowedSorts())
            ->jsonPaginate();
    }

    /**
     * Execute the query and return a collection of results.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return QueryBuilder::for(AiImageMeta::class)
            ->allowedFilters($this->getAllowedFilters())
            ->allowedSorts($this->getAllowedSorts())
            ->get();
    }
}
