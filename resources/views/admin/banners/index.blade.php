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
                                                        <th scope="col">{{ __('blog.image') }}</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class="list">
                                                        @foreach ($data as $item)
                                                            <tr>
                                                                <th scope="row">{{ $item->id }}</th>
                                                                <td><a class="title"
                                                                        href="{{ route('admins.banners.show', $item) }}">{{ $item->title }}</a>
                                                                </td>
                                                                <td class="img"><img
                                                                        src="{{ Storage::url($item->image) }}"
                                                                        alt="">
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-primary"
                                                                        href="{{ route('admins.banners.edit', $item) }}">{{ __('blog.edit') }}</a>
                                                                    <form
                                                                        action="{{ route('admins.banners.destroy', $item) }}"
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
