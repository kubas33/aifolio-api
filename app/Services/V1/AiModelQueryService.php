<?php

namespace App\Services\V1;

use App\Models\AiModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class AiModelQueryService
{
    /**
     * Get the allowed sorts for the query.
     *
     * @return array
     */
    private function getAllowedSorts(): array
    {
        return [
            AllowedSort::field('id', 'id'),
            AllowedSort::field('name', 'name'),
            AllowedSort::field('slug', 'slug'),
            AllowedSort::field('modelUrl', 'model_url'),
            AllowedSort::field('createdAt', 'created_at'),
            AllowedSort::field('updatedAt', 'updated_at'),
            AllowedSort::field('deletedAt', 'deleted_at'),
        ];
    }

    /**
     * Get the allowed filters for the query.
     *
     * @return array
     */
    private function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id', 'id'),
            AllowedFilter::partial('name', 'name'),
            AllowedFilter::partial('slug', 'slug'),
            AllowedFilter::partial('modelUrl', 'model_url'),
            AllowedFilter::partial('createdAt', 'created_at'),
            AllowedFilter::partial('updatedAt', 'updated_at'),
            AllowedFilter::partial('deletedAt', 'deleted_at'),
        ];
    }

    /**
     * Perform a paginated query.
     *
     * @return LengthAwarePaginator
     */
    public function query(): LengthAwarePaginator
    {
        return QueryBuilder::for(AiModel::class)
            ->allowedFilters($this->getAllowedFilters())
            ->allowedSorts($this->getAllowedSorts())
            ->jsonPaginate();
    }

    /**
     * Get all the records.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return QueryBuilder::for(AiModel::class)
            ->allowedFilters($this->getAllowedFilters())
            ->allowedSorts($this->getAllowedSorts())
            ->get();
    }
}
