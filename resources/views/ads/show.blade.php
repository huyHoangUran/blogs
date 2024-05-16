@include('layouts.header')
<section class="content">
    <div>
        <ul class="breadcrumb">
            <li><a href="">{{ __('title.home') }}</a></li>
            <li><a href="">{{ __('title.detail_blog') }}</a></li>
        </ul>
    </div>
</section>


<div class="detail">
    <div class="title">
        <h1>{{ $ads->title }}</h1>
    </div>
    <div class="image">
        <img src="{{ Storage::url($ads->image) }}" class="" alt="Image of blog" />
    </div>
    <div class="guide-list">
        <div class="guide-item">
            <div class="guide-img">
                <img src="{{ asset('/images/joca7nD.jpg') }}" alt="">
            </div>
            <div class="guide-detail">
                <p>Trang chủ:

                    <a href="{{ $ads->home }}" class="detail-title">
                        {{ $ads->home }}
                    </a>
                </p>

                <p>Fanpage Hỗ trợ:<a class="" href="{{ $ads->fanpage }}">{{ $ads->fanpage }}</a></p>
                <div class="guide-time">
                    <b>Phiên bản:</b>
                    <p>{{ $ads->category->name }}</p> - <b>Máy chủ:</b>
                    <p>{{ $ads->server }}</p>

                </div>
                <div class="guide-time">
                    <b>Loại Mu:</b>
                    <p>{{ $ads->reset->name }},Exp: {{ $ads->exp }}x , Drop: {{ $ads->drop }} %</p>

                </div>
                <div class="guide-time">
                    <b>Alpha test:</b>
                    <p>{{ $ads->alpha_test }}</p> - <b>Open beta:</b>
                    <p>{{ $ads->open_beta }}</p>

                </div>

            </div>

        </div>
    </div>
    <div class="title">
        {!! $ads->short_description !!}
    </div>
    <div class="description">
        {!! $ads->description !!}
    </div>
</div>
@include('layouts.footer')
