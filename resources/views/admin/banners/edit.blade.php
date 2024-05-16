@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="create">
                <h1>Create Banner</h1>
                <form action="{{ route('admins.banners.update', $banner) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-input ">
                        <label for="">Create Banner <span>*</span></label>
                        <input class="title" type="text" name="title" placeholder="Enter title"
                            value="{{ $banner->title }}">
                        @error('title')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input ">
                        <label for="">Link web <span>*</span></label>
                        <input class="title" type="text" name="link"
                            placeholder="Enter your web link ex: https://mumoira.tv/" value="{{ $banner->link }}">
                        @error('link')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input ">
                        <label class="p-2" for="">Choose your banner (size 780px * 110px) <span>*</span></label>
                        <!-- Trong phần HTML của bạn -->
                        <input id="image" class="title" type="file" name="image" accept="image/*"
                            placeholder="{{ __('blog.title') }}">

                        @error('image')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <img id="image-preview" name="image" src="{{ Storage::url($banner->image) }}" alt="Image preview"
                        style="">
                    <div class="form-input submit">
                        <button>{{ __('blog.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Trong phần JavaScript của bạn
        document.getElementById('image').addEventListener('change', function() {
            var fileInput = this;
            if (fileInput.files && fileInput.files[0]) {
                var file = fileInput.files[0];
                var fileType = file.type;

                if (fileType.startsWith('image/')) {
                    var img = new Image();
                    img.src = URL.createObjectURL(file);
                    img.onload = function() {
                        var width = img.naturalWidth,
                            height = img.naturalHeight;
                        URL.revokeObjectURL(img.src);

                        if (width !== 780 || height !== 110) {
                            alert('Kích thước ảnh phải là 780px * 110px.');
                            fileInput.value = ''; // Xóa file đã chọn
                        } else {
                            // Hiển thị hình ảnh
                            var imgPreview = document.getElementById('image-preview');
                            imgPreview.style.display = 'block';
                            imgPreview.src = URL.createObjectURL(file);
                        }
                    };
                } else {
                    alert('Chỉ cho phép tải lên ảnh.');
                    fileInput.value = ''; // Xóa file đã chọn nếu không phải ảnh
                }
            }
        });
    </script>
@endsection
