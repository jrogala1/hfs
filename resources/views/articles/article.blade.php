@extends('templates.article_template')

@section('content')
    <div class="padding_correction">
        <div class="mx-auto row mb-2" style="width: 60%;">

            @if( $recommended->isEmpty() )
                <div class="text-center" style="margin: 0 auto; padding-bottom: 5%"><h3>Rekomendowane artykuły są chwilowo niedostępne.</h3></div>
            @else

            @foreach($recommended as $recomendation)
            <div class="mx-auto col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-success">Polecane z kategorii <i>{{ $recomendation->category->name }}</i></strong>
                        <h3 class="mb-0">
                            <a class="text-dark" href="#">{{ $recomendation->title }}</a>
                        </h3>
                        <div class="mb-1 text-muted">{{ $recomendation->created_at }}</div>
                        <p class="card-text mb-auto">{{ substr($recomendation->description,0,60) . '...' }}</p>
                        <a href="{{ url('/articles/show/' . $recomendation->id) }}">Przejdź do ściągi</a>
                    </div>
                </div>
            </div>
            @endforeach

            @endif

        </div>
    </div>

    <main role="main" class="container">
        <div class="row">

            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Samopomoc Studencka
                </h3>
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $article->title}}</h2>
                    <p class="blog-post-meta">Utworzono: {{ $article->created_at}} przez <b>{{ $article->user->name }}</b></p>
                    <hr>
                    <img src="{{ $article->image_file }}" style="max-width: 700px; max-height: 1000px; margin: 3%;">
                    <hr>
                    <p>
                    {{ $article->description }}
                    </p>
                </div><!-- /.blog-post -->

                <nav class="blog-pagination justify-content" style="padding-top: 10%;">
             {{--       @if ( $recommended->isEmpty() )
                        @else--}}
                    @if ( empty($randomArticle[0]['id']))
                        @else
                    <a class="btn btn-outline-primary" href="{{ $randomArticle[0]['id'] }}">Losowy artykuł</a>
                    @endif
{{--
                    @endif
--}}
                    {{--<a class="btn btn-outline-success" href="">Podoba mi się</a>
                    <a class="btn btn-outline-danger" href="">Nie podoba mi się</a>--}}

                </nav>

            </div><!-- /.blog-main -->

            <aside class="col-md-4 blog-sidebar">
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">O Autorze</h4>
                    <p class="mb-0">Imię: {{ $article->user->name }}</p>
                    <p class="mb-0">Członek od: {{ $article->user->created_at }}</p>
                    <p class="mb-0">Opublikowane ściągi: {{ $user_prop['amount'] }}</p>
                    <p class="mb-0">Ulubiona kategoria: {{ $user_prop['category'][0]['name'] }}</p>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">Pliki do pobrania</h4>
                    <ol class="list-unstyled mb-0">
                        &nbsp;
                    </ol>
                    <ol class="list-unstyled mb-0">
                        <li><a href="{{ $article->article_file }}" download><button type="button" class="btn btn-info">Pobierz ściągę <b>{{ $article->title }}</b></button></a></li>
                    </ol>
                </div>
            </aside><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main><!-- /.container -->
    </div>
@endsection