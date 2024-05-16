<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\BannerService;

class BannerController extends Controller
{
    const PATH_VIEW = 'admin.banners.';

    public function __construct(
        private BannerService $bannerService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->bannerService->getAlls();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view(self::PATH_VIEW.__FUNCTION__);
        return redirect()->route('admins.banners.index')->with('success', 'Successfully created');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required|min:4',
            'link'=> 'required|min:4',
            'image' => 'required|image|max:5120',
        ]);
        $this->bannerService->store($request->all());
        return redirect()->route('admins.banners.index')->with('success', 'Successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view(self::PATH_VIEW.__FUNCTION__, compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title'=> 'required|min:4',
            'link'=> 'required|min:4',
            'image' => 'required|image|max:5120',
        ]);
        $this->bannerService->update($request, $banner);
        return redirect()->route('admins.banners.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $this->bannerService->delete($banner);
        return redirect()->route('admins.banners.index')->with('success', 'Successfully deleted');
    }
}
