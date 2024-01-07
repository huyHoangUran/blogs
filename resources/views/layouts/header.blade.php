@extends('layouts.base')
@section('title', __('title.create_blog'))
@section('content')
    <header>
        <div class="menu" id="navbar">
            <nav class="left nav-menu">
                <a href="{{ route('home') }}" class="logo"><img class="img" src="{{ asset('/images/Group_155.png') }}"
                        alt="" /></a>
                <div class="form-search">
                    <form class="box" action="{{ route('home') }}" method="GET">
                        <input class="search" type="text" name="search" placeholder="Search..."
                            value="{{ old('search') }}">
                        <button type="submit"><i class="bx bx-search"></i></button>
                    </form>
                </div>
            </nav>
            <nav class="right nav-menu create-blog">
                @if (auth()->check())
                    <form action="#" method="post">
                        <button type="button" class="first loged">{{ __('auth.top') }}</button>
                    </form>
                    <form action="{{ route('blogs.create') }}" method="post">
                        @csrf
                        @method('get')
                        <button class="second">{{ __('title.create_blog') }}</button>
                    </form>
                    <li><a class="third">{{ auth()->user()->name }}</a></li>
                    <li>
                        <div class="user-btn">
                            <p class="user"><i class="fouth bx bx-user-circle"></i></p>
                            <div class="user-list">
                                <a href="{{ route('users.home') }}">{{ __('auth.my_profile') }}</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button id="logoutBtn">{{ __('auth.logout') }}</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @else
                    <form action="#" method="post">
                        <button type="button" class="first">{{ __('auth.top') }}</button>
                    </form>
                    <li>
                        <a href="{{ route('login') }}" class="third login">{{ __('auth.login') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="fouth">{{ __('auth.sign_up') }}</a>
                    </li>
                @endif
            </nav>
        </div>
        <div class="menu-mobile">
            <div class="nav">
                <a href="" class="toggle-btn" id="toggle">
                    <i class="bx bx-menu"></i>
                </a>
                <a href="{{ route('home') }}" class="logo-header"><img src="{{ asset('/images/Group_155.png') }}"
                        alt="" /></a>
                <a href="" class="search-btn">
                    <i class="bx bx-search"></i>
                </a>
            </div>
            <div class="navbar-links">
                <ul>
                    <li><a href="">T{{ __('auth.top') }}</a></li>
                    <li><a href="{{ route('blogs.create') }}">{{ __('title.create_blog') }}</a></li>
                </ul>
            </div>
        </div>
    </header>
@endsection
