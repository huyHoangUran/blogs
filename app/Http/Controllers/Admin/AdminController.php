<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class AdminController extends Controller
{
    public function __construct(private DashboardService $dashboardService, private UserService $userService)
    {
    }

    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy') ?? 'likes';
        $topLikesComments = $this->dashboardService->getTopLikeComment($sortBy);
        return view('admin.index', compact('topLikesComments'));
    }

    public function getAllUsers()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    public function blockUser(User $user)
    {
        $this->userService->blockUser($user);
        return back();
    }
}
