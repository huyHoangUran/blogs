<?php

namespace App\Http\Controllers;

use App\Services\User\BlogService;
use App\Services\User\UserService;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;

class UserController extends Controller
{

    public function __construct(private UserService $userService, private BlogService $blogService)
    {
    }

    public function index()
    {
        $user = auth()->user();
        $response = $this->userService->profile();
        $myBlogLists = $this->blogService->getMyBlogs($user->id);
        $likedBlogLists = $this->blogService->getLikedBlogs($user);
        return view('user.profile', compact('response', 'myBlogLists', 'likedBlogLists'));
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('user.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $this->userService->update($request->only('name', 'image'), $user);
        return redirect()->route('users.home')->with('success', __('auth.profile_update'));
    }

    public function changePassword()
    {
        return view('user.change_password');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        $this->userService->updatePassword($request->only('password'), $user);
        return redirect()->route('users.home')->with('success', __('auth.password_success'));
    }
}
