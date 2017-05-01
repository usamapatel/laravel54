@extends('layouts.app')

@section('pageStyle')
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="title m-b-md">
            {{ __("Laravel") }}
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">{{ __("Documentation") }}</a>
            <a href="https://laracasts.com">{{ __("Laracasts") }}</a>
            <a href="https://laravel-news.com">{{ __("News") }}</a>
            <a href="https://forge.laravel.com">{{ __("Forge") }}</a>
            <a href="https://github.com/laravel/laravel">{{ __("GitHub") }}</a>
        </div>
    </div>
@endsection