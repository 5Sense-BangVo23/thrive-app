<?php

namespace App\Builders\Admin;

use App\Models\TblCategory;
use Illuminate\Database\Eloquent\Collection;

class CategoryBuilder
{
    protected $query;

    public function __construct()
    {
        $this->query = TblCategory::query();
    }

    public function all(array $columns = ['*']): Collection
    {
        if (empty($columns)) {
            $columns = ['*'];
        }

        return $this->query->select($columns)->get();
    }

    public function find(int $id, array $columns = ['*']): ?TblCategory
    {
        return $this->query->select($columns)->find($id);
    }

    public function where(string $field, $value): self
    {
        $this->query->where($field, $value);
        return $this;
    }

    public function create(array $data): TblCategory
    {
        return TblCategory::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $category = $this->find($id);
        if (!$category) {
            return false;
        }

        $category->name = $data['name'];
        $category->description = $data['description'];
        
        if (array_key_exists('status', $data)) {
            $category->setPublishStatus($data['status']);
        }

        return $category->update($data);
    }

    public function delete(int $id): bool
    {
        $category = $this->find($id);
        if (!$category) {
            return false;
        }
        return $category->delete();
    }
    
    public function whereName(string $name): self
    {
        if (str_starts_with($name, '%')) {
            $name = ltrim($name, '%');
            $this->query->where('name', 'like', "{$name}%");
        } else {
            $this->query->where('name', 'like', "%{$name}%");
        }
        return $this;
    }

    public function whereDescription(string $description): self
    {
        if (str_starts_with($description, '%')) {
            $description = ltrim($description, '%');
            $this->query->where('description', 'like', "{$description}%");
        } else {
            $this->query->where('description', 'like', "%{$description}%");
        }
        return $this;
    }

   public function whereStatus(string $status): self
    {
        $this->query->whereHas('published', function ($query) use ($status) {
            $query->where('status', $status);
        });
        return $this;
    }



    public function withProducts(): self
    {
        $this->query->with('products');
        return $this;
    }

    public function get(array $columns = ['*']): Collection
    {
        return $this->query->select($columns)->get();
    }

    public function paginate(int $perPage = 15)
    {
        return $this->query->paginate($perPage);
    }
}
