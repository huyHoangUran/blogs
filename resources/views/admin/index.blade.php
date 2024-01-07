@extends('admin.layouts.master')
@section('title', __('admin.title_dashboard'))
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="content-header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('admin.dashboard') }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('admin.top_likes') }}</h3>
                                <div class="select">
                                    <form action="{{ route('admins.index') }}" method="get">
                                        <select name="sortBy" onchange="this.form.submit()">
                                            <option value="likes" @if (request('sortBy') == 'likes') selected @endif>
                                                {{ __('admin.likes') }}</option>
                                            <option value="comments" @if (request('sortBy') == 'comments') selected @endif>
                                                {{ __('admin.comments') }}</option>
                                        </select>
                                    </form>

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    @foreach ($topLikesComments as $item)
                                        <li class="nav-item active">
                                            <a href="{{ route('blogs.show', $item) }}"
                                                class="nav-link clamp-text">{{ $item->title }}
                                                <span class="badge bg-primary float-right">
                                                    @if (isset($item->likes_count))
                                                        {{ $item->likes_count }} {{ __('title.likes') }}
                                                    @else
                                                        {{ $item->comments_count }} {{ __('title.comments') }}
                                                    @endif
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
