@extends('layouts.base')
@section('content')
    <div class="create">
        <div class="nav">
            <a href="{{ route('home') }}"><img src="{{ asset('images/Group_155.png') }}" alt=""></a>
            <h1>{{ __('title.edit_profile') }}</h1>
        </div>
        <div class="form">
            <form action="{{ route('users.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-input ">
                    <label for="">{{ __('blog.email') }} <span>*</span></label>
                    <input class="title" type="text" disabled placeholder="{{ __('blog.title') }}"
                        value="{{ $user->email }}">
                </div>
                <div class="form-input ">
                    <label for="">{{ __('blog.name') }} <span>*</span></label>
                    <input class="title" type="text" name="name" placeholder="{{ __('blog.title') }}"
                        value="{{ $user->name }}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-input upload">
                    <label class="first" for="img">{{ __('blog.upload_avatar') }}</label>
                    <label class="second" for="img">{{ __('blog.upload_avatar') }}</label>
                    <input type="file" hidden name="image" id="img">
                    <img src="" alt="" class="outer" id="preview">
                </div>
                <img src="{{ $user->getUserImageURL() }}" alt="" id="old" class="outer">
                <div class="form-input submit">
                    <button class="btn btn-success">{{ __('blog.update') }}</button>
                </div>
            </form>
        </div>
        <a class="cancel" href="{{ route('users.home') }}">{{ __('auth.cancel') }}</a>
    </div>
    @include('layouts.footer')
@endsection
