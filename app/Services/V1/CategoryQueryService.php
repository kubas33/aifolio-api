<?php

namespace App\Services\V1;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryQueryService
{
/**
     * Get the allowed sorts.
     *
     * @return array
     */
    private function getAllowedSorts(): array
    {
        return [
            AllowedSort::field('id', 'id'),
            AllowedSort::field('name', 'name'),
            AllowedSort::field('slug', 'slug'),
            AllowedSort::field('createdAt', 'created_at'),
            AllowedSort::field('updatedAt', 'updated_at'),
            AllowedSort::field('deletedAt', 'deleted_at'),
        ];
    }

    /**
     * Get the allowed filters.
     *
     * @return array
     */
    private function getAllowedFilters(): array
    {
        return [
            AllowedFilter::exact('id', 'id'),
            AllowedFilter::partial('name', 'name'),
            AllowedFilter::partial('slug', 'slug'),
            AllowedFilter::partial('createdAt', 'created_at'),
            AllowedFilter::partial('updatedAt', 'updated_at'),
            AllowedFilter::partial('deletedAt', 'deleted_at'),
        ];
    }

    /**
     * Get the paginated query results.
     *
     * @return LengthAwarePaginator
     */
    public function query(): LengthAwarePaginator
    {
        return QueryBuilder::for(Category::class)
        ->allowedFilters($this->getAllowedFilters())
        ->allowedSorts($this->getAllowedSorts())
        ->jsonPaginate();
    }

    /**
     * Get all the query results.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return QueryBuilder::for(Category::class)
            ->allowedFilters($this->getAllowedFilters())
            ->allowedSorts($this->getAllowedSorts())
            ->get();
    }
}
