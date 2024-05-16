@extends('admin.layouts.master')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('title.list_blog') }}</h3>
                                <div class="filter">
                                    <form action="{{ route('admins.blog.list') }}" method="get">
                                        <select name="status" id="status">
                                            <option value="">{{ __('blog.all') }}</option>
                                            <option value="{{ App\Models\Blog::STATUS_ACTIVE }}"
                                                {{ request('status') == App\Models\Blog::STATUS_ACTIVE ? 'selected' : '' }}>
                                                {{ __('blog.active') }}
                                            </option>
                                            <option value="{{ App\Models\Blog::STATUS_INACTIVE }}"
                                                {{ request('status') == App\Models\Blog::STATUS_INACTIVE ? 'selected' : '' }}>
                                                    {{ __('blog.inactive') }}</option>
                                        </select>
                                        <input type="date" name="date" id="date" value="{{ request('date') }}">
                                        <button class="submit-filter" type="submit">{{ __('blog.apply') }}</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('blog.id') }}</th>
                                                        <th scope="col">{{ __('blog.title') }}</th>
                                                        <th scope="col">{{ __('blog.author') }}</th>
                                                        <th scope="col">{{ __('blog.category') }}</th>
                                                        <th scope="col">{{ __('blog.image') }}</th>
                                                        <th scope="col">{{ __('blog.status') }}</th>
                                                        <th scope="col">{{ __('blog.date') }}</th>
                                                        <th class="add" scope="col"><a class="btn btn-success"
                                                                href="{{ route('blogs.create') }}">{{ __('blog.create') }}</a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class="list">
                                                        @foreach ($blogs as $item)
                                                            <tr>
                                                                <th scope="row">{{ $item->id }}</th>
                                                                <td><a class="title"
                                                                        href="{{ route('blogs.show', $item) }}">{{ $item->title }}</a>
                                                                </td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ $item->category->name }}</td>
                                                                <td class="banner"><img
                                                                        src="{{ Storage::url($item->img) }}"
                                                                        alt="">
                                                                </td>
                                                                <td>{{ $item->status == App\Models\Blog::STATUS_ACTIVE ? 'Active' : 'Inactive' }}
                                                                </td>
                                                                <td>{{ $item->created_at->diffForHumans() }}
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('blogs.approved', $item) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('put')
                                                                        <button
                                                                            class="btn btn-secondary">{{ $item->status == \App\Models\Blog::STATUS_ACTIVE ? __('blog.approved') : __('blog.approve') }}</button>
                                                                    </form>
                                                                    <a class="btn btn-primary"
                                                                        href="{{ route('blogs.edit', $item) }}">{{ __('blog.edit') }}</a>
                                                                    <form action="{{ route('blogs.delete', $item) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="btn btn-danger"
                                                                            onclick="return confirm('are you sure')">{{ __('blog.delete') }}</button>
                                                                    </form>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </div>
                                                </tbody>
                                            </table>
                                            {{ $blogs->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
