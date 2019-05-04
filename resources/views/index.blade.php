@extends('templates.template')

@section('content')

    <main role="main" class="inner cover">
        <h1 class="cover-heading">Studenci dla studentów!</h1>
        <p class="lead">Jesteś studentem i potrzebujesz pomocy? Chcesz wspomóc innych studentów w zaliczeniu semestru? Samopomoc studencka jest właśnie dla Ciebie!</p>
        @guest
        <p class="lead">Dołącz już teraz.</p>
        <br>
        <p class="lead">
            <a href="{{ url('/login') }}" class="btn btn-lg btn-secondary">Zaloguj się</a>
        </p>
            @else
         <p class="lead">Sprawdź dostępne zasoby.</p>
            <br>
            <p class="lead">
                <a href="{{ route('topArticles') }}" class="btn btn-lg btn-secondary">Artykuły</a>
            </p>
        @endguest
    </main>
@endsection('content')
