@extends('layouts.base')
@section('title', 'Blog | Register')

@section('content')
    <div class="containers">
        <div class="logo">
            <a href="{{ route('home') }}" class="logo"><img class="img" src="{{ asset('/images/Group_155.png') }}"></a>
        </div>
        <div class="form">
            <h1>Sign up</h1>
            <form action="{{ route('post.register') }}" method="POST">
                @csrf
                <div class="form-input">
                    <label for="name">Username <span>* </span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="email">Email <span>* </span></label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}">
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
                <div div class="form-input">
                    <label for="re_password">Password Confirm <span>* </span></label>
                    <input type="password" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror   
                </div>
                <div class="button">
                    <button class="" type="submit">Sign up</button>
                </div>
                <a class="end" href="{{ route('login') }}">{{ __('auth.have_account') }}</a>
            </form>
        </div>
    </div>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.js') }}"></script>
@endsection
