@extends('layouts.base')
@section('title', 'Blog | Forgot Password')

@section('content')
    <div class="containers">
        <div class="logo">
            <img src="{{ asset('images/Group_155.png') }}" alt="">
        </div>
        <div class="form">
            <h1>{{ __('auth.forgot') }}</h1>
            <form action="{{ route('post.forgot_password') }}" method="POST">
                @csrf
                <div class="form-input">
                    <label for="email">Email <span>* </span></label>
                    <input type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="button">
                    <button class="" type="submit">{{ __('auth.forgot') }}</button>
                </div>
                <a class="end" href="{{ route('login') }}">{{ __('auth.login') }}</a>
            </form>
        </div>
    </div>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.js') }}"></script>
@endsection
