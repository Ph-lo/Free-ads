<!DOCTYPE html>
<html>

<head>
    <title>Free ads</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="/">Freeads</a>

            <div class="dropdown">
                <button id="banner-menu" class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('assets/menu.png') }}" alt="menu icon">
                </button>
                <div id="banner-menu-content" class="dropdown-menu" aria-label="dropdownMenuButton">

                    @if(!Auth::guest())
                    <a class="dropdown-item" href="{{ route('/') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ route('messages') }}">Messages</a>
                    <a class="dropdown-item" href="{{ route('my.ads') }}">My ads</a>
                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">Sign out</a>
                    @else
                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="{{ URL::asset('js/app.js'),}}"></script>
</body>

</html>