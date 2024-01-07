<?php
namespace App\Services\User;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAll(): Collection
    {
        return Category::select('id', 'name')->get();
    }
}
