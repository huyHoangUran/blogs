<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\PointController;
use App\Http\Controllers\admin\ResetController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\VersionController;
use App\Http\Controllers\Admin\BlogController as BlogControllerAdmin;
use App\Http\Controllers\Admin\CategoryController as CategoryControllerAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'postRegister'])->name('post.register');
        Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login');
        Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot_password');
        Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('post.forgot_password');
    });
});

Route::middleware(['auth','status'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
        Route::get('/home', [UserController::class, 'index'])->name('home');
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/update', [UserController::class, 'update'])->name('update');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change_password');
        Route::put('/change-password', [UserController::class, 'updatePassword'])->name('update_password');
    });
    Route::resource('blogs', BlogController::class);
    Route::resource('ads', AdsController::class);

    Route::post('/upload', [ AdsController::class, 'upload'])->name('ckeditor.upload');

    Route::group(['as' => 'comments.', 'prefix' => 'comments'], function () {
        Route::post('/store/{blog_id}', [CommentController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CommentController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('delete');
    });
    Route::post('/{blogId}/like', [LikeController::class, 'like'])->name('blogs.like');
});

Route::group(['as' => 'blogs.', 'prefix' => 'blogs'], function () {
    Route::get('/{blog}', [BlogController::class, 'show'])->name('show')->middleware('view.blog.not.approved');
});

Route::get('/', [BlogController::class, 'home'])->name('home');

Route::middleware(['auth','admin'])->group(function () {
    Route::group(['as' => 'blogs.', 'prefix' => 'blogs'], function () {
        Route::put('/approved/{blog}', [BlogController::class, 'approved'])->name('approved');
        Route::delete('/delete/{blog}', [BlogController::class, 'destroy'])->name('delete');
    });
    
    Route::group(['as' => 'admins.', 'prefix' => 'admins'], function () {
        Route::resource('banners', BannerController::class);
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/blog/list', [BlogControllerAdmin::class, 'list'])->name('blog.list');
        Route::resource('categories', CategoryControllerAdmin::class);
        Route::resource('resets', ResetController::class);
        Route::resource('versions', VersionController::class);
        Route::resource('points', PointController::class);
        Route::get('/users', [AdminController::class, 'getAllUsers'])->name('users.index');
        Route::put('/users/block-user/{user}', [AdminController::class, 'blockUser'])->name('users.block_user');
    });
});
