@extends('templates.template')

@section('content')

    <main role="main" class="inner cover">
        <h1 class="cover-heading">Błąd :(</h1>
        <p class="lead">Nie znaleziono żądanego artykułu. Sprawdź adres strony lub przejdź do strony z artykułami.</p>
        <br>
        <p class="lead">
            <a href="{{ url('/articles') }}" class="btn btn-lg btn-secondary">Powrót do artykułów</a>
        </p>
    </main>
@endsection('content')
