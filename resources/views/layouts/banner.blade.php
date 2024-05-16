<div class="banner">
    @foreach ($banners as $item)
        <a href="{{ $item->link }}"><img src="{{ Storage::url($item->image) }}" alt=""></a>
    @endforeach

</div>
