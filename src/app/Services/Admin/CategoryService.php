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


    private function searchById(int $id, array $columns = ['*']): Collection
    {
        return $this->builder->where('id', $id)->get($columns);
    }


    private function searchByName(string $name, array $columns = ['*']): Collection
    {
        return $this->builder->whereName($name)
                             ->get($columns);
    }
    
    private function searchByDescription(string $description, array $columns = ['*']): Collection
    {
        return $this->builder
            ->whereDescription($description)
            ->get($columns);
    }

    private function searchByStatus(string $status, array $columns = ['*']): Collection
    {
        return $this->builder
            ->whereStatus($status)
            ->get($columns);
    }

    private function searchByStatusAndName(string $status, string $name, array $columns = ['*']): Collection
    {
        return $this->builder
            ->whereStatus($status)
            ->whereName($name)
            ->get($columns);
    }

    

    private function getWithProductsPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->builder
            ->withProducts()
            ->paginate($perPage);
    }

    public function search(?string $searchTerm, ?string $status, array $columns = ['*']): \Illuminate\Support\Collection
    {
        switch (true) {
            case ($searchTerm && is_numeric($searchTerm) && !$status):
                return $this->searchById((int)$searchTerm, $columns);

            case ($searchTerm && !$status):
                return $this->searchByName($searchTerm, $columns);

            case (!$searchTerm && $status):
                return $this->searchByStatus($status, $columns);
            // search by status and name
            case ($searchTerm && $status):
                return $this->searchByStatusAndName($status, $searchTerm, $columns);

            default:
                return $this->getAll($columns);
        }
    }

    public function paginate($items, int $perPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $currentItems,
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }



}