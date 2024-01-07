<?php

namespace App\Services\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\EmailVerifyMail;
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
            $token = Str::random(60);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'image' => self::DEFAULT_IMG,
                'email_verified_token' => $token,
            ]);
            $mailData = [
                'title' => __('auth.hi_user') . $user->name,
                'token' => $user->email_verified_token,
            ];
            Mail::to($user->email)->send(new EmailVerifyMail($mailData));
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verifyEmail(string $token): bool | string
    {
        try {
            $user = User::where('email_verified_token', $token)->first();
            if (!$user) {
                return __('auth.email_unregistered');
            }
            if ($user->email_verified_at != null) {
                return __('auth.invalid');
            }
            if ($user->created_at->addHours(2)->isPast()) {
                $user->delete();
                return __('auth.re_register');
            }
            return $user->update([
                    'email_verified_at' => now(),
                    'status' => User::STATUS_ACTIVE,
                ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login(array $data): bool | string
    {
        try {
            $user = User::where('email', $data['email'])->orWhere('name', $data['email'])->first();
            $password = $data['password'];
            if ($user) {
                if (Hash::check($password, $user->password)) {
                    if (empty($user->email_verified_at)) {
                        return __('auth.verify_check_mail');
                    }
                    
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
