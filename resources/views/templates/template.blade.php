<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="WSZIB FOR EDUCATION PURPOSE">
    <meta name="author" content="Jakub Rogala">
    <title>Samopomoc Studencka</title>

    <link rel="icon" href="{{ asset('css/siteIcon.png') }}">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/cover/">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="{{ asset('css/bootstrap/mainpage.css') }}" rel="stylesheet">

</head>
<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">{{__('Samopomoc Studencka')}}</h3>
            @guest
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link {{ Route::is('startpage') ? 'active' : '' }}" href="{{ url('/') }}">Strona główna</a>
                <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" href="{{ url('/login') }}" >Logowanie</a>
                <a class="nav-link {{ Route::is('register') ? 'active' : '' }}" href="{{ url('/register') }}">Rejestracja</a>
                <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ url('/about') }}" href="#">Jak to działa?</a>
                <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}" href="<?php ?>">Kontakt</a>
            </nav>
                @else
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="{{ url('/') }}">Strona główna</a>
                    <a class="nav-link" href="{{ url('/articles') }}">Lista artykułów</a>
                    <a class="nav-link" href="<?php ?>">Kontakt</a>
                </nav>
            @endguest
        </div>
    </header>

    @yield('content')

    <footer class="mastfoot mt-auto">
        <div class="mainPageFooter">
            <p>Samopomoc Studencka &copy; 2019 by Jakub Rogala</p>
            <p>(only for educational usage)</p>
        </div>
    </footer>
</div>
</body>
</html>