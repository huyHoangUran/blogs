<?php

namespace App\Services\Admin;

use Exception;
use App\Models\Banner;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class BannerService
{
    const PATH_UPLOAD = 'public/banners';


    public function getAlls(): Collection
    {
        return Banner::latest()->get();
    }

    public function store(array $data): Banner
    {
        try {
            $imageName = 'images/Rectangle_82.png';
            if (isset($data['image'])) {
                $imageName = $data['image']->store(self::PATH_UPLOAD);
            }
            return Banner::create([
                'title' => $data['title'],
                'link' => $data['link'],
                'image' => $imageName,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Request $request, Banner $banner): bool
    {
        try {
            $data = $request->except('image');
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
                if ($banner->image !== null && Storage::exists($banner->image)) {
                    Storage::delete($banner->image);
                }
            }
            return $banner->update($data);
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
