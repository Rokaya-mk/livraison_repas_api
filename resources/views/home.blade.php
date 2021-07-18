@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
@stop
@section('content')
<div class="home-page">
    <input type="checkbox" id="nav-toggle">

    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>
                <span class="lab la-accusoft"></span><span>
                    {{-- Accusoft --}}
                </span>
            </h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href=" {{ route('dashboard') }} " class="active">
                        <span class="las la-igloo"></span>
                        <span>Panneau de contrôle </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('foods') }}">
                        <span><i class="las la-utensils"></i></span>

                        <span>Repas</span>
                    </a>
                </li>
                <li>
                    <a href=" {{ route('categories') }} ">
                        <span class="las la-igloo"></span>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('promos') }}">
                        <span><i class="las la-gift"></i></span>
                        <span>Promotions</span>
                    </a>
                </li>
                <li>
                    <a href=" {{ route('orders') }} ">
                        <span><i class="las la-shopping-bag"></i></span>
                        <span>Commandes</span>
                    </a>
                </li>
                <li>
                    <a href=" {{ route('delivery-G') }} ">
                        <span><i class="las la-truck"></i></span>
                        <span>Livreurs</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span ><i class="las la-users"></i></span>
                        <span>Clients</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h1>
                <label for="nav-toggle" id="">
                    <span class="las la-bars"></span>
                </label>
                Dashboard

            </h1>
            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search">
            </div>
            <div class="user-wrapper">
                <img src="images/162297520672.jpg" width="30px" height="30px" alt="">
                <div>
                    <h4>admin Name</h4>
                    <small>Super admin</small>
                </div>
            </div>
        </header>
        <div class="main-home">

            @yield('dash')
        </div>

    </div>
</div>

@endsection
