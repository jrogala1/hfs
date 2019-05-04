@extends('templates.article_template')
<section class="jumbotron text-center" id="Jumbo1">
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @guest {{redirect()->route('login')}}
        @else
            <h1 class="jumbotron-heading">Przeglądarka</h1>
            <p class="lead">{{ Auth::user()->name }}, zacznij przeglądać treści już teraz!</p>
        @endguest
    </div>
</section>
@section('content')
    <style>
        /* Style the input field */
        #TableForm {
            padding: 20px;
            border: 0;
            width: 100%;
            max-width: 1200px;
            border-radius: 0;
            margin: 0 auto;
        }

        #searchbar {
            background-image: url({{asset('css/icons/searchicon.png')}});
            background-position: 10px 13px;
            background-repeat: no-repeat;
            width: 100%;
            max-width: 500px;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin: 0 auto 20px;
            float: none;
        }

        .results tr[visible='false'],
        .no-result{
            display:none;
        }

        .results tr[visible='true']{
            display:table-row;
        }

        .counter{
            padding:8px;
            color:#ccc;
        }

        .pagination
        {
            padding-top: 15px;
            margin: 0 auto;
        }

        #clickable_icon a:link,
        #clickable_icon a:visited,
        #clickable_icon a:hover,
        #clickable_icon a:active
        {
            text-decoration: none;
            color: white;
            background-color: white;
        }
    </style>
{{--    <div class="container">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <input class="form-control" id="dropdown" type="text" placeholder="Search..">
                <li><a href="#">HTML</a></li>
                <li><a href="#">CSS</a></li>
                <li><a href="#">JavaScript</a></li>
                <li><a href="#">jQuery</a></li>
                <li><a href="#">Bootstrap</a></li>
                <li><a href="#">Angular</a></li>
            </ul>
        </div>
    </div>--}}
    <div class="row" style="padding-top: 15px;">
        <input type="text" id="searchbar" placeholder="Wyszukaj w tabeli.." title="Type in a name">
    </div>
    <div class="row">
        <table class="table table-striped table-bordered table-light table-hover results" id="TableForm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tytuł ściągi</th>
                <th scope="col">Utworzone przez</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Data utworzenia</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @if( $articles->isEmpty())
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td>Nie ma żadnych treści do wyświetlenia.</td>
                    <td></td>
                    <td></td>
                </tr>
                @else
            @foreach($articles as $article)
                <tr>
                    <th scope="row">@if( $article->id > 9 ) {{'00'}}@elseif($article->id > 99){{'0'}}@elseif($article->id > 999){{''}}@else {{'000'}}@endif{{ $article->id }}</th>
                    <td>{{ $article->title}}</td>
                    <td>{{ $article->user->name }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>
                        <a href="{{ URL::to('articles/show/' . $article->id) }}" class="btn btn-dark" id="clickable_icon"><i class="fas fa-glasses"></i></a>
                        @if(Auth::user()->id == $article->user_id)
                        <a href="{{ URL::to('articles/action/edit/' . $article->id) }}" class="btn btn-dark" id="clickable_icon" ><i class="far fa-edit"></i></a>
                        <a href="{{ URL::to('articles/action/remove/' . $article->id) }}" class="btn btn-dark" id="clickable_icon"><i class="fas fa-trash"></i></a>

                            @endif
                    </td>
                </tr>
            @endforeach
            @endif
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i>Brak wyników wyszukiwania.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
       {{ $articles->onFirstPage() }} {{ $articles->links() }}
    </div>



<script>
    $(document).ready(function(){
        $("#dropdown").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".dropdown-menu li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });


        $("#searchbar").keyup(function () {
            var searchTerm = $("#searchbar").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
            });

            $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','false');
            });

            $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','true');
            });

            var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

            if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
        });
    </script>
@endsection('content')