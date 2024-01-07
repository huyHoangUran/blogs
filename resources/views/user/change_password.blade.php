@extends('layouts.base')
@section('title', __('title.change_password'))

@section('content')
    <div class="containers">
        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('images/Group_155.png') }}" alt=""></a>
        </div>
        <div class="form">
            <h1>{{ __('title.change_password') }}</h1>
            <form action="{{ route('users.update_password') }}" method="POST">
                @csrf
                @method('put')
                <div class="form-input">
                    <label for="password">{{ __('title.your_password') }}<span>*</span></label>
                    <input type="password" name="old_password">
                    @error('old_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="password">{{ __('title.new_password') }}<span>*</span></label>
                    <input type="password" name="password" id="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div div class="form-input">
                    <label for="re_password">{{ __('title.confirm_password') }}<span>*</span></label>
                    <input type="password" name="password_confirmation">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="button">
                    <button class="" type="submit">{{ __('title.confirm') }}</button>
                </div>
                <a class="end" href="{{ route('users.home') }}">{{ __('auth.cancel') }}</a>
            </form>
        </div>
    </div>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.js') }}"></script>
@endsection
