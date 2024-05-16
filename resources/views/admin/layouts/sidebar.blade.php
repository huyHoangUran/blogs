<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/Group_155.png') }}" alt="">
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Storage::url(auth()->user()->image) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admins.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('admin.dashboard') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admins.index') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('admin.dashboard') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('blogs.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Blogs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admins.blog.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List blog</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admins.categories.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List categories</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.banners.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Banners
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admins.banners.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List banner</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.resets.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Resets
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admins.resets.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List resets</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.points.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Point
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: nonep;">
                        <li class="nav-item">
                            <a href="{{ route('admins.points.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List points</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('admins.users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List users</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
