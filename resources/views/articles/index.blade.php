@extends('templates.article_template')

@section('content')
<main role="main">

    <section class="jumbotron text-center" id="Jumbo1">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @guest
                @else
            <h1 class="jumbotron-heading">Witaj {{ Auth::user()->name }}!</h1>
            <p class="lead">Korzystaj z zasobów społeczności studenckiej oraz dodawaj nowe treści!</p>
            <p class="lead">Sprawdź popularne treści poniżej lub przejdź do innej sekcji strony.</p>
            <p id="hyper_buttons">
                <a href="{{ route('browse') }}" class="btn btn-primary my-2">Przeglądaj</a>
                <a href="{{ route('article_createform') }}" class="btn btn-success my-2">Dodaj treść</a>
            </p>
                @endguest
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            @if( $top->isEmpty() )

                <div class="text-center"><h1>Nie ma żadnych treści do wyświetlenia. Utwórz pierwszą ściąge!</h1></div>

            @endif

            <div class="row">
                @foreach($top as $article)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="bd-placeholder-img card-img-top" style="max-height: 500px; max-width: 300px; margin: 0 auto; padding-top: 3%;" src="{{ url($article->image_file) }}">
                        <title>Placeholder</title>
                        </img>

         {{--               <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
                                                                                                             focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>--}}
                        <p class="text-center" id="title">{{ $article->title }}</p>
                        <div class="card-body">
                            <p class="card-text">{{ substr($article->description,0,40) . '...' }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ url('/articles/show/' . $article->id) }}" role="button" class="btn btn-sm btn-outline-secondary">Czytaj dalej</a>
                                    @if(Auth::user()->id == $article->user_id)
                                    <a href="" role="button" class="btn btn-sm btn-outline-secondary">Edytuj</a>
                                        @endif
                                </div>
                                <small class="text-muted">Utworzył: {{ $article->user->name }}</small>
                            </div>
                            <div class="padding_correction">
                            <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $article->created_at }}</small>
                            <small class="text-muted" style="font-size: 70%">Kategoria: {{ $article->category->name }}</small>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
    @endsection('content')