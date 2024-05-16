<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PointService;
use App\Http\Requests\CategoryRequest;

class PointController extends Controller
{
    const PATH_VIEW = 'admin.points.';

    public function __construct(
        private PointService $pointService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->pointService->getAlls();
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
        $this->pointService->store($request->only('name'));
        return redirect()->route('admins.points.index')->with('success', 'Successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $point)
    {
        return view(self::PATH_VIEW.__FUNCTION__, compact('point'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Point $point)
    {
        $this->pointService->update($request, $point);
        return redirect()->route('admins.points.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        $this->pointService->delete($point);
        return redirect()->route('admins.points.index')->with('success', 'Successfully deleted');
    }
}
