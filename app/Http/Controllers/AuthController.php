<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;

class AuthController extends Controller
{
    public AuthService $authService;

    public function __construct(AuthService $authSevice)
    {
        $this->authService = $authSevice;
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postRegister(AuthRequest $request)
    {
        $response = $this->authService->register($request->only('name', 'email', 'password'));
        if ($response) {
            return redirect()->route('register')->with('success', __('auth.verify_check_mail'));
        }
        return redirect()->route('register')->with('error', __('auth.email_unregistered'));
    }

    public function verifyEmail(string $token)
    {
        $response = $this->authService->verifyEmail($token);
        if (is_string($response)) {
            return redirect()->route('register')->with('error', $response);
        }
        return redirect()->route('register')->with('success', __('auth.verified'));
    }

    public function postLogin(LoginRequest $request)
    {
        $response = $this->authService->login($request->only('email', 'password', 'remember'));
        if (is_string($response)) {
            return redirect()->route('login')->with('error', $response);
        }
        return redirect()->route('home');
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', __('auth.logout'));
    }

    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        $response = $this->authService->postForgotPassword($request->only('email'));
        if (is_string($response)) {
            return redirect()->route('forgot_password')->with('error', $response);
        }
        return redirect()->route('login')->with('success', __('auth.new_password'));
    }
}
