<?php

namespace App\Services\Admin;

use Exception;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAlls(): Collection
    {
        return Category::latest()->get();
    }

    public function store(array $data): Category
    {
        try {
            return Category::create(['name' => $data['name']]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(CategoryRequest $data, Category $category): bool
    {
        try {
            return $category->update([
                'name'  => $data['name'],
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Category $category): bool
    {
        try {
            return $category->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
