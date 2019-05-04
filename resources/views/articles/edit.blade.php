@extends('templates.article_template')

<link href="{{ asset('css/util/tooltip.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<section class="jumbotron text-center" id="Jumbo1">
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <h1 class="jumbotron-heading">Edycja ściągi</h1>
</section>

@section('content')
    <form id="create_form" class="border border-light p-5" method="post" action="{{ route('editArticle', $article->id )}}" enctype="multipart/form-data">
        <input hidden name="id" value="{{ $article->id }}">
        <div class="row">
            <div class="col-auto">
                @if ($errors->any())
                    <div class="alert alert-warning" role="alert" style="max-width: 550px; max-height: 140px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">

                    <div class="col-7 col-md-7 p-2">
                        <label for="staticEmail">Zalogowany użytkownik: {{ Auth::user()->name }}</label>
                    </div>
                    <div class="col-2 col-md-2 p-2">
                        <a href="#">To nie Ty?</a>
                    </div>
                </div>

                <div class="row">
                    @csrf

                    <div class="col-sm-5 p-lg-2">
                        <label for="title">Tytuł ściągi *</label>
                        <div class="row" style="margin-left: 0px; padding-bottom: 10px;">
                            <small class="text-muted">Opis może zawierać od 10 do 150 znaków.</small>
                        </div>
                        <input type="text" name="title" class="form-control mb-4" placeholder="Tytuł" value="{{$article->title}}">
                    </div>

                    <div class="col-sm-9 p-lg-2">
                        <label for="description">Opis ściągi *</label>
                        <div class="row" style="margin-left: 0px; padding-bottom: 10px;">
                            <small class="text-muted">Opis może zawierać od 30 do 700 znaków.</small>
                        </div>
                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Opis">{{$article->description}}</textarea>
                        <div class="row" style="margin-left: 0px;">
                            <small class="text-muted" id="charNum"></small>
                        </div>
                    </div>

                    <div class="col-sm-4 p-lg-2">
                        <label for="category">Kategoria *</label>
                        <select class="form-control" name="category">
                            @foreach($categories as $category)
                                <option @if($category->id == $article->category_id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div>
                            {{-- $category->general_category --}}
                        </div>
                    </div>
                </div>

                <div class="row">


                </div>

                <div class="row">
                    <div class="col-4 p-lg-2">
                        <button class="btn btn-info btn-block my-4 mb-2" type="submit">Edytuj</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4 p-lg-2">
                        <small class="text-muted">* Pola obowiązkowe</small>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection