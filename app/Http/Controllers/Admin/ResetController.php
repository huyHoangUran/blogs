<?php

namespace App\Http\Controllers\admin;

use App\Models\Reset;
use App\Http\Controllers\Controller;
use App\Services\Admin\ResetService;
use App\Http\Requests\CategoryRequest;

class ResetController extends Controller
{
    const PATH_VIEW = 'admin.resets.';

    public function __construct(
        private ResetService $resetService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->resetService->getAlls();
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
        $this->resetService->store($request->only('name'));
        return redirect()->route('admins.resets.index')->with('success', 'Successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reset $reset)
    {
        return view(self::PATH_VIEW.__FUNCTION__, compact('reset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Reset $reset)
    {
        $this->resetService->update($request, $reset);
        return redirect()->route('admins.resets.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reset $reset)
    {
        $this->resetService->delete($reset);
        return redirect()->route('admins.resets.index')->with('success', 'Successfully deleted');
    }
}
