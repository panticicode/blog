<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--Font-Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Main Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Styles Toastr -->
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                <div class="row">
                   @if(Auth :: check())
                        <div class="col-lg-4">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            @if(Auth::user()->admin)
                                <li class="list-group-item">
                                <a href="{{ route('user.index') }}">Users</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('user.create') }}">Create User</a>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <a href="{{ route('user.profile') }}">My Profile</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('category.index') }}">Categories</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('category.create') }}">Create new Category</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('tag.index') }}">Tags</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('tag.create') }}">Create new Tag</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('post.index') }}">Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('post.trashed') }}">Trashed Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('post.create') }}">Create new Post</a>
                            </li>
                             @if(Auth::user()->admin)
                                <li class="list-group-item">
                                    <a href="{{ route('setting.index') }}">Settings</a>
                                </li>
                            @endif
                        </ul>
                        </div> 
                        <div class="col-lg-8">
                            @yield('content')
                        </div>   
                   @else
                        <div class="col-lg-12">
                            @yield('content')
                        </div>         
                   @endif         
                </div>
            </div>     
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Scripts Toaster -->
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    @yield('scripts')
    <script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @elseif(Session::has('info'))
        toastr.info("{{ Session::get('info') }}")
    @elseif(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}") 
    @elseif(Session::has('danger'))
        toastr.error("{{ Session::get('danger') }}")         
    @endif
    </script>
    
</body>
</html>




