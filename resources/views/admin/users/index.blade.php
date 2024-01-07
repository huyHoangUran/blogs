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
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Avatar</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">{{ __('blog.status') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class="list">
                                                        @foreach ($users as $item)
                                                            <tr>
                                                                <th scope="row">{{ $item->id }}</th>
                                                                <td><a class="title"
                                                                        href="{{ route('blogs.show', $item) }}">{{ $item->name }}</a>
                                                                </td>
                                                                <td>{{ $item->email }}</td>
                                                                <td class="banner"><img
                                                                        src="{{ Storage::url($item->image) }}"
                                                                        alt="">
                                                                </td>
                                                                <td>{{ $item->status == App\Models\Blog::STATUS_ACTIVE ? 'Active' : 'Blocked' }}
                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('admins.users.block_user', $item) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('put')
                                                                        <button
                                                                            class="btn btn-secondary">{{ $item->status == \App\Models\User::STATUS_ACTIVE ? 'Block' : 'Unblock' }}</button>
                                                                    </form>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </div>
                                                </tbody>
                                            </table>
                                            {{ $users->links() }}
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
