<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('blog.categories.index') }}">Головна</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.categories.create') }}">Додати категорію</a>
                </li>
                @if(count($categoryList))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.posts.create') }}">Додати пост</a>
                </li>
                    @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Entries Column -->
        <main class="col-md-8">
            @yield('content')
        </main>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Користувачі перейшли з браузерів:</h5>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($userStatistic as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$item->browser}}
                            <span class="badge badge-primary badge-pill">{{$item->count_browser}}</span>
                        </li>
                    </ul>

                    @endforeach
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Категорії</h5>
                <div class="wrap card-body ">
                    <div class="row ">
                        <div class="col-lg-12 ">
                            <ol class="mb-0 ">
                                @foreach($categoryList as $item)
                                    <li>
                                        <a href="{{ route('blog.categories.show', $item->id) }}">{{$item->name}}</a>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Blog 2019</p>
    </div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

