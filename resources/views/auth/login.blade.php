@extends('layouts.base')
@section('title', 'Blog | Login')

@section('content')
    <div class="containers">
        <div class="logo">
            <a href="{{ route('home') }}" class="logo"><img class="img" src="{{ asset('/images/Group_155.png') }}"></a>
        </div>
        <div class="form">
            <h1>{{ __('auth.sign_in') }}</h1>
            <form action="{{ route('post.login') }}" method="POST">
                @csrf
                <div class="form-input">
                    <label for="email">Username or email <span>* </span></label>
                    <input type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="password">Password <span>* </span></label>
                    <input type="password" name="password" id="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="option">
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember password</label>
                    </div>
                    <div class="forgot">
                        <a href="{{ route('forgot_password') }}">{{ __('auth.forgot') }}</a>
                    </div>
                </div>
                <div class="button">
                    <button class="" type="submit">{{ __('auth.login') }}</button>
                </div>
                <a class="end" href="{{ route('register') }}">{{ __('auth.register') }}</a>
            </form>
        </div>
    </div>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.js') }}"></script>
@endsection
