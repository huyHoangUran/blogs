@include('layouts.header')
@include('layouts.banner')
<section class="">
    <div class="list-title">
        <h1 class=""><i class="bi bi-arrow-right-square"></i> Danh sách Mu vip</h1>

    </div>
    <div class="list-vip">
        @foreach ($adsVip as $key => $item)
            <div class="item-vip">
                <div class="item-left">
                    <h3>{{ $key += 1 }}</h3>
                    <h5>[Chi tiết ]</h5>
                </div>
                <div class="item-midle">
                    <div class="item-banner">
                        <img src="{{ Storage::url($item->image) }}" alt="">
                    </div>
                    <a class="item-name" href="">{{ $item->name }}</a>
                </div>
                <div class="item-right">
                    <h5><b>VIP Vàng</b></h5>
                    <p>Alpha: {{ $item->alpha_test }}</p>
                    <p>Open: {{ $item->open_beta }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="list-title">
        <h1 class=""><i class="bi bi-arrow-right-square"></i> Danh sách Mu miễn phí hôm nay</h1>

    </div>
    <div class="list-free">
        @foreach ($ads as $key => $item)
            <div class="item-free">
                <div class="item-left">
                    <h3>{{ $key += 1 }}</h3>
                </div>
                <div class="item-midle">

                    <a class="item-name" href="{{ route('ads.show', $item->id) }}">{{ $item->name }}</a>

                    <div class="item-detail">
                        <div>
                            <p>- Server: Hỏa long</p>
                            <p>- Phiên bản: Seasion 6</p>
                        </div>
                        <div>
                            <p>- Alpha Test: 08/05/2024 (13h)</p>
                            <p>- Open Beta: <b>09/05/2024 (13h)</b></p>
                        </div>
                    </div>
                </div>
                <div class="item-right">
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="title-guide-update">
        <h1>Hướng dẫn MU Online mới cập nhật</h1>
    </div>
    <div class="guide-list">
        <div class="guide-item">
            <div class="guide-img">
                <img src="{{ asset('/images/joca7nD.jpg') }}" alt="">
            </div>
            <div class="guide-detail">
                <a href="#" class="detail-title">
                    Hướng dẫn xoay cánh 3 (wing 3) Mu hôm nay
                </a>
                <p class="description">Nếu anh em nào chưa biết xoay Wings 3 trong Server Mu Online thì có thể xem bài
                    hướng dẫn của mumoira.tv bên dưới để biết cách xoay nha.</p>
                <div class="guide-time">
                    <h4>Hướng dẫn Mu > Hệ thống ép đồ</h4>
                    <p><i class="bi bi-clock"></i> 15/12/2025</p>
                </div>
            </div>

        </div>
        <div class="show-more">
            <a href="#" class="btn btn-danger"><i class="bi bi-eye"></i> Xem thêm hướng dẫn</a>
        </div>
    </div> --}}

</section>
<script src="{{ asset('resources/js/app.js') }}"></script>
@include('layouts.footer')
