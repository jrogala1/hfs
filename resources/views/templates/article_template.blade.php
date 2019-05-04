<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="WSZIB FOR EDUCATION PURPOSE">
    <meta name="author" content="Jakub Rogala">
    <title>Samopomoc Studencka</title>

    <link rel="icon" href="{{ asset('css/siteIcon.png') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- JQuery and Boostrap's javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('css/album.css') }}" rel="stylesheet">


<body>



<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="{{ route('topArticles') }}">Samopomoc Studencka</a>

    <div class="collapse navbar-collapse flex-grow-1 text-right" id="SiteNavigator">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('topArticles') ? 'active' : '' }}"  href="{{ route('topArticles') }}">Strona główna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('browse') ? 'active' : '' }}" href="{{ route('browse') }}">Przeglądaj</a>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Moje akcje
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <a class="dropdown-item" href="{{ route('article_createform') }}">Dodaj treść</a>
                        @if(Auth::user()->type == "2")
                        <a class="dropdown-item" href="{{ route('admin') }}">Konsola</a>
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Wyloguj') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>


@yield('content')

<!--<div class="collapse bg-dark" id="navbarHeader">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Samopomoc Studencka</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="{{ url('/') }}">Strona główna</a>
                <a class="nav-link" href="{{ url('/login') }}">Logowanie</a>
                <a class="nav-link" href="#">Jak to działa?</a>
                <a class="nav-link" href="<?php ?>">Kontakt</a>
                <a class="nav-link" href="{{ url('/articles') }}">Testy Articles</a>
            </nav>
        </div>
    </header>
</div>
<hr style="border-color: rgba(175,178,174,0.42)"/>-->

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Powrót do góry strony</a>
        </p>
        <p>
            <a href="#">Kontakt</a>
        </p>
        <p>Samopomoc Studencka &copy; 2019 by Jakub Rogala</p>
        <p>(only for educational usage)</p>
    </div>
</footer>