<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Julio Altamiranda">
    {{-- styles --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title')</title>
</head>
<body class="theme-admin">
    <div class="loader-container" style="position: fixed;">
        <div class="loader">
        </div>
    </div>
    <div class="container">
        <div class="navbar">
            <div class="navbar-current-page">
                Control Panel - <b>@yield('currentPage','Dashboard')</b>
            </div>
            <div class="navbar-user">
                <p>Logged in as {{auth()->user()->name}}</p>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    @method('put')
                    <button type="submit">(<span>Logout</span>)</button>
                </form>
            </div>
        </div>
        <main>
            <div class="navbar-left">
                <div class="navbar-left-body">
                    <ul>
                        <li><a href="{{route('dashboard')}}" class="{{currentRoute('dashboard')?'active':''}}">Dashboard</a></li>
                        <li><a href="{{route('dashboard.products')}}" class="{{currentRoute('dashboard/products')?'active':''}}">Products</a></li>
                        <li><a href="{{route('dashboard.profile')}}" class="{{currentRoute('dashboard/profile')?'active':''}}">Profile</a></li>
                    </ul>
                </div>
                <div class="navbar-left-footer">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        @method('put')
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
            <div id="app">
                @yield('content')
            </div>
        </main>
    </div>
    <footer>
        <p>copyrith&copy; all right reserved</p>
    </footer>
    {{-- scripts --}}
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://kit.fontawesome.com/0ac3a6a222.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('.loader-container').style.display='none'
        });
    </script>
</body>
</html>