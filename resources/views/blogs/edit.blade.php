@include('layouts.header')
<section class="content">
    <div>
        <ul class="breadcrumb">
            <li><a href="">{{ __('title.home') }}</a></li>
            <li><a href="">{{ __('blog.edit_blog') }}</a></li>
        </ul>
    </div>
    <div class="create">
        <h1>{{ __('title.create_blog') }}</h1>
        <form action="{{ route('blogs.update', $blog) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-input category">
                <label for="">{{ __('blog.category') }} <span>*</span></label>
                <select name="category_id" id="">
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if ($item->id == $blog->category_id) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-input ">
                <label for="">{{ __('blog.title') }} <span>*</span></label>
                <input class="title" type="text" name="title" placeholder="{{ __('blog.title') }}"
                    value="{{ $blog->title }}">
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input upload">
                <label class="first" for="img">{{ __('blog.upload_image') }}</label>
                <label class="second" for="img">{{ __('blog.upload_image') }}</label>
                <input type="file" hidden name="img" id="img">
                <img src="" alt="" class="outer" id="preview">
            </div>
            <img src="{{ \Storage::url($blog->img) }}" alt="" id="old" class="outer">
            <div class="form-input description">
                <label for="">{{ __('blog.description') }} <span>*</span></label>
                <textarea name="content" id="" cols="30" rows="10" placeholder="{{ __('blog.description') }}">{{ $blog->content }}</textarea>
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
