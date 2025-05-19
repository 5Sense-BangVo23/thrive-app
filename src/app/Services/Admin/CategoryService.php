<?php

namespace App\Services\Admin;

use App\Builders\Admin\CategoryBuilder;
use App\Models\TblCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryService{

    protected CategoryBuilder $builder;

    public function __construct(CategoryBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function newCategory(): TblCategory
    {
        return new TblCategory();
    }

    public function getAll(array $columns = ['*']): Collection
    {
        return $this->builder->all($columns);
    }

    public function getById(int $id, array $columns = ['*']): ?TblCategory
    {
        return $this->builder->find($id, $columns);
    }

    public function create(array $data): TblCategory
    {
        return $this->builder->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->builder->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->builder->delete($id);
    }

    public function searchByName(string $name, array $columns = ['*']): Collection
    {
        return $this->builder
            ->whereName($name)
            ->get($columns);
    }

    public function getWithProductsPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->builder
            ->withProducts()
            ->paginate($perPage);
    }

}