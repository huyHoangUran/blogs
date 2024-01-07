@include('layouts.header')
<section class="content">
    <div>
        <ul class="breadcrumb">
            <li><a href="">{{ __('title.home') }}</a></li>
            <li><a href="">{{ __('title.detail_blog') }}</a></li>
        </ul>
    </div>
</section>
<div class="fade modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('blog.delete') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>{{ __('blog.want_to_delete') }}</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="close btnc" data-bs-dismiss="modal">{{ __('blog.close') }}</button>
                <form action="{{ route('blogs.destroy', $blog) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="delete btnc">{{ __('blog.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="detail">
    <div class="title">
        <h1>{{ $blog->title }}</h1>
    </div>
    <div class="author-function">
        <div class="author">
            <div class="avatar">
                <img src="{{ Storage::exists($blog->user->image) ? Storage::url($blog->user->image) : asset($blog->user->image) }}"
                    alt="">
            </div>
            <div class="name">
                <h5>{{ $blog->user->name }}</h5>
                <p>{{ $blog->updated_at->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="function">
            @auth
                <div id="data" comment-create-route="{{ route('comments.store', $blog->id) }}"
                    error-message="{{ __('auth.error') }}"
                    image-user={{ Storage::exists($blog->user->image) ? Storage::url($blog->user->image) : asset($blog->user->image) }}>
                </div>
                @php $user = auth()->user() @endphp
                @if ($user->id === $blog->user_id || $user->role === \App\Models\User::ADMIN_ROLE)
                    <div class="fn ">
                        @can('isAdmin', $user)
                            <form action="{{ route('blogs.approved', $blog) }}" method="post">
                                @csrf
                                @method('put')
                                <button
                                    class="approved">{{ $blog->status == \App\Models\Blog::STATUS_ACTIVE ? __('blog.approved') : __('blog.not_approved') }}</button>
                            </form>
                        @else
                            <button
                                class="approved">{{ $blog->status == \App\Models\Blog::STATUS_ACTIVE ? __('blog.approved') : __('blog.not_approved') }}</button>
                        @endcan
                    </div>
                    @can('checkUpdate', $blog)
                        <div class="fn">
                            <a class="edit" href="{{ route('blogs.edit', $blog) }}">{{ __('blog.edit') }}</a>
                        </div>
                    @endcan
                    @can('checkDelete', $blog)
                        <div class="fn">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="delete">{{ __('blog.delete_blog') }}</button>
                        </div>
                    @endcan
                @endif
            @endauth
        </div>
    </div>
    <div class="image">
        <img src="{{ Storage::exists($blog->img) ? Storage::url($blog->img) : asset('images/Rectangle_82.png') }}"
            class="" alt="Image of blog" /> 
    </div>
    <div class="description">
        <p>{{ $blog->content }}</p>
    </div>
    <div class="like" data-like-route="{{ route('blogs.like', ['blogId' => $blog->id]) }}">
        @auth
            @if ($liked)
                <button class="like-btn"><i class="bi bi-heart-fill"></i></button>
            @else
                <button class="like-btn"><i class="bi bi-heart"></i></button>
            @endif
        @else
            <a href="{{ route('login') }}"><i class="bi bi-heart"></i></a>
        @endauth
        <span class="count-like">{{ $blog->likes()->count() }}</span>
    </div>
    <div class="related">
        <h3>{{ __('blog.related') }}</h3>
    </div>
    <div class="border-hr">
        <hr>
    </div>
    <div class="blog">
        <div class="row row-cols-1 row-cols-md-4">
            @foreach ($relatedBlogs as $item)
                <div class="col">
                    <div class="card">
                        <img src="{{ Storage::exists($item->img) ? Storage::url($item->img) : asset('images/Rectangle_82.png') }}"
                            class="" alt="Image of blog" />
                        <div class="card-body">
                            <a href="{{ route('blogs.show', $item) }}" class="card-title">{{ $item->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <h3>{{ __('blog.comment') }}</h3>
    <div class="border-hr">
        <hr>
    </div>
    <div class="comment">
        @auth
            <div class="input">
                <img src="{{ Storage::exists($user->image) ? Storage::url($user->image) : asset('images/Rectangle_82.png') }}"
                    alt="">
                <form>
                    <textarea name="content" id="contentComment" cols="30" rows="10" placeholder="Comment"></textarea>
                    <button id="commentForm" class="send"><i class='bx bx-send'></i></button>
                    <p id="error" class="btn btn-danger"></p>
                </form>
            </div>
        @endauth
        @include('components.comment')
    </div>
</div>
@include('layouts.footer')
