<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    const PATH_UPLOAD = 'public/images';

    public function profile(): array
    {
        return Auth::user()->only('name', 'email');
    }

    public function update(array $data, User $user): bool
    {
        try {
            $oldPathImg = '';
            if (data_get($data, 'image')) {
                $oldPathImg = $user->image;
                $data['image'] = Storage::put(self::PATH_UPLOAD, $data['image']);
            }
            $user->update($data);
            Storage::delete($oldPathImg);
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updatePassword(array $data, User $user): bool
    {
        try {
            $password = Hash::make($data['password']);
            return $user->update([
                'password' => $password,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAllUsers(): LengthAwarePaginator
    {
        return User::where('status', '!=', User::STATUS_INACTIVE)->where('role', '!=', User::ADMIN_ROLE)->latest()->paginate(9);
    }

    public function blockUser(User $user)
    {
        $status = $user->status == User::STATUS_ACTIVE ? User::STATUS_BLOCKED : User::STATUS_ACTIVE;
        return $user->update(['status' => $status]);
    }
}
