<?php

namespace App\Http\Controllers\admin;

use App\Models\Version;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Admin\VersionService;

class VersionController extends Controller
{
    const PATH_VIEW = 'admin.versions.';

    public function __construct(
        private VersionService $versionService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->versionService->getAlls();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->versionService->store($request->only('name'));
        return redirect()->route('admins.versions.index')->with('success', 'Successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Version $version)
    {
        return view(self::PATH_VIEW.__FUNCTION__, compact('version'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Version $version)
    {
        $this->versionService->update($request, $version);
        return redirect()->route('admins.versions.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Version $version)
    {
        $this->versionService->delete($version);
        return redirect()->route('admins.versions.index')->with('success', 'Successfully deleted');
    }
}
