<?php

namespace App\Services\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPasswordMail;

/**
 * Class AuthService.
 */
class AuthService
{
    const DEFAULT_IMG = "images/team-1.jpg";
    
    public function register(array $data): bool | string
    {
        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'image' => self::DEFAULT_IMG,
            ]);
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function login(array $data): bool | string
    {
        try {
            $user = User::where('email', $data['email'])->first();
            $password = $data['password'];
            if ($user) {
                if (Hash::check($password, $user->password)) {
                    if ($user->status == User::STATUS_BLOCKED) {
                        return __('auth.account_block');
                    }

                    Auth::login($user, array_key_exists('remember', $data)?true:false);
                    return true;
                }
                return __('auth.error');
            }
            return __('auth.error_email_password');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function postForgotPassword(array $data): bool | string
    {
        try {
            $user = User::where('email', $data['email'])->first();
            if ($user && !empty($user->email_verified_at)) {
                $password = Str::random(12);
                $user->update([
                    'password' => Hash::make($password),
                ]);
                $mailData = [
                    'title' => __('auth.hi_user') . $user->name,
                    'password' => $password,
                ];
                Mail::to($user->email)->send(new NewPasswordMail($mailData));
                return true;
            }
            return __('auth.email_invalid');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
