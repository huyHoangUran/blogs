@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="create">
                <h1>Edit Reset</h1>
                <form action="{{ route('admins.resets.update', $reset) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-input ">
                        <label for="">{{ __('blog.title') }} <span>*</span></label>
                        <input class="title" type="text" name="name" placeholder="{{ __('blog.title') }}"
                            value="{{ $reset->name }}">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input submit">
                        <button>{{ __('blog.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
