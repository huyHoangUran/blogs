@include('layouts.header')
<section class="content">
    <div>
        <ul class="breadcrumb">
            <li><a href="">{{ __('title.home') }}</a></li>
            <li><a href="">{{ __('title.create_blog') }}</a></li>
        </ul>
    </div>
    <div class="create">
        <h1>{{ __('title.create_blog') }}</h1>
        <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-input category">
                <label for="">{{ __('blog.category') }} <span>*</span></label>
                <select name="category_id" id="">
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-input ">
                <label for="">{{ __('blog.title') }} <span>*</span></label>
                <input class="title" type="text" name="title" placeholder="{{ __('blog.title') }}"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input upload">
                <label class="first" for="img">{{ __('blog.upload_image') }}</label>
                <label class="second" for="img">{{ __('blog.upload_image') }}</label>
                <input type="file" hidden name="img" id="img">
                <img src="" alt="" id="preview">
            </div>
            <div class="form-input description">
                <label for="">{{ __('blog.description') }} <span>*</span></label>
                <textarea name="content" id="" cols="30" rows="10" placeholder="{{ __('blog.description') }}">{{ old('content') }}</textarea>
                @error('content')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input submit">
                <button>{{ __('blog.submit') }}</button>
            </div>
        </form>
    </div>
</section>
<script src="{{ asset('resources/js/app.js') }}"></script>
@include('layouts.footer')
