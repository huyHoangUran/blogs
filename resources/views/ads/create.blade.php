@include('layouts.base')
@include('layouts.header')
<section class="content">
    <div>
        <ul class="breadcrumb">
            <li><a href="">{{ __('title.home') }}</a></li>
            <li><a href="">Create Ads</a></li>
        </ul>
    </div>
    <div class="create">
        <h1>{{ __('title.create_blog') }}</h1>
        <form action="{{ route('ads.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-input ">
                <label for="">Tên Mu <span>*</span></label>
                <input class="title" type="text" name="name" placeholder="{{ __('blog.title') }}"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input ">
                <label for="">Trang chủ<span>*</span></label>
                <input class="title" type="text" name="home" placeholder="Link trang chủ MU"
                    value="{{ old('home') }}">
                @error('home')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input ">
                <label for="">Fanpage hỗ trợ<span>*</span></label>
                <input class="title" type="text" name="fanpage" placeholder="Nhập đường link fanpage hỗ trợ"
                    value="{{ old('fanpage') }}">
                @error('fanpage')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input ">
                <label for="">Tên server<span>*</span></label>
                <input class="title" type="text" name="server" placeholder="Nhập tên server"
                    value="{{ old('server ') }}">
                @error('server')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input ">
                <label for="">Miêu tả ngắn gọn<span>*</span></label>
                <input class="title" type="text" name="short_description"
                    placeholder="Nhập đường link short_description hỗ trợ" value="{{ old('short_description ') }}">
                @error('fanpage')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input ">
                <label for="">Alpha test<span>*</span></label>
                <input class="title" type="datetime-local" name="alpha_test" placeholder="giờ alpha test"
                    value="{{ old('alpha_test') }}">
                @error('alpha_test')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input ">
                <label for="">Open beta<span>*</span></label>
                <input class="title" type="datetime-local" name="open_beta" placeholder="giờ open beta"
                    value="{{ old('open_beta') }}">
                @error('open_beta')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input ">
                <label for="">EXP<span>*</span></label>
                <input class="title" type="number" name="exp"
                    placeholder="EXP Rate 
                    (vd: 1x, 5x, 100x, 500x, 9999x)"
                    value="{{ old('exp') }}">
                @error('exp')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input ">
                <label for="">DROP<span>*</span></label>
                <input class="title" type="number" name="drop"
                    placeholder="DROP RATE
                    (vd: 10%, 40%, 50%, 80%)" value="{{ old('drop') }}">
                @error('drop')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input ">
                <label for="">Anti hack<span>*</span></label>
                <input class="title" type="text" name="anti_hack" placeholder="Nhập tên loại hack"
                    value="{{ old('anti_hack') }}">
                @error('anti_hack')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input category">
                <label for="">{{ __('blog.category') }} <span>*</span></label>
                <select name="category_id" id="">
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input category">
                <label for="">Chọn phiên bản<span>*</span></label>
                <select name="version_id" id="">
                    @foreach ($versions as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('version_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input category">
                <label for="">Chọn kiểu reset <span>*</span></label>
                <select name="reset_id" id="">
                    @foreach ($resets as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('reset_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input category">
                <label for="">Chọn kiểu point <span>*</span></label>
                <select name="point_id" id="">
                    @foreach ($points as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('point_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-input upload">
                <label class="first" for="image">{{ __('blog.upload_image') }}</label>
                <label class="second" for="image">{{ __('blog.upload_image') }}</label>
                <input type="file" hidden name="image" id="image" accept="image/*">
                <img id="image-preview" src="" alt="Image preview" style="display: none;">

            </div>
            <div class="form-input description">
                <label for="">{{ __('blog.description') }} <span>*</span></label>
                <textarea name="description" id="summernote" cols="30" rows="10"></textarea>

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
<script>
    $('#summernote').summernote({
        placeholder: 'Enter the text',
        tabsize: 2,
        height: 100
    });
</script>
<script>
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
                fileInput.value = '';
            }
        }
    });
</script>
<script src="{{ asset('resources/js/app.js') }}"></script>
@include('layouts.footer')
