<?php

namespace App\Services\Admin;

use Exception;
use App\Models\Point;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Collection;

class PointService
{
    public function getAlls(): Collection
    {
        return Point::latest()->get();
    }

    public function store(array $data): Point
    {
        try {
            return Point::create(['name' => $data['name']]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(CategoryRequest $data, Point $point): bool
    {
        try {
            return $point->update([
                'name'  => $data['name'],
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Point $point): bool
    {
        try {
            return $point->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
