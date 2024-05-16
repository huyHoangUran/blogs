<?php

namespace App\Services\Admin;

use Exception;
use App\Models\Reset;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Collection;

class ResetService
{
    public function getAlls(): Collection
    {
        return Reset::latest()->get();
    }

    public function store(array $data): Reset
    {
        try {
            return Reset::create(['name' => $data['name']]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(CategoryRequest $data, Reset $reset): bool
    {
        try {
            return $reset->update([
                'name'  => $data['name'],
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Reset $reset): bool
    {
        try {
            return $reset->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
