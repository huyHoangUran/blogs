<?php

namespace App\Services\Admin;

use Exception;
use App\Models\Version;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Collection;

class VersionService
{
    public function getAlls(): Collection
    {
        return Version::latest()->get();
    }

    public function store(array $data): Version
    {
        try {
            return Version::create(['name' => $data['name']]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(CategoryRequest $data, Version $version): bool
    {
        try {
            return $version->update([
                'name'  => $data['name'],
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Version $version): bool
    {
        try {
            return $version->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
