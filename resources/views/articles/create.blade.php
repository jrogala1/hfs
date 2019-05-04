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
    <h1 class="jumbotron-heading">Tworzenie nowej ściągi</h1>
</section>

@section('content')
<form id="create_form" class="border border-light p-5" method="post" action="{{ route('article_create') }}" enctype="multipart/form-data">

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
            <input type="text" name="title" class="form-control mb-4" placeholder="Tytuł">
        </div>

        <div class="col-sm-9 p-lg-2">
            <label for="description">Opis ściągi *</label>
            <div class="row" style="margin-left: 0px; padding-bottom: 10px;">
                <small class="text-muted">Opis może zawierać od 30 do 700 znaków.</small>
            </div>
            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Opis" ></textarea>
            <div class="row" style="margin-left: 0px;">
                <small class="text-muted" id="charNum"></small>
            </div>
        </div>

        <div class="col-sm-4 p-lg-2">
            <label for="category">Kategoria *</label>
            <select class="form-control" name="category">
                @foreach($categories as $category)
                    <option>{{ $category->name }}</option>
                @endforeach
            </select>
            <div>
            {{-- $category->general_category --}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-15 p-lg-2">
                <div class="col-sm-15">
                    <label for="art_file">Plik ze ściągą *</label>
                    <div class="row" style="margin-left: 0px;">
                        <small class="text-muted">Plik ze ściągą musi być plikiem typu doc, pdf, docx, txt.</small>
                    </div>
                    <input type="file" name="art_file" class="art_file custom-file-input" accept="application/pdf,.docx,.doc,.odt,.txt">
                <div class="input-group my-3">
                    <input type="text" class="form-control custom-file-input" disabled placeholder="Wybierz plik.." id="artfile">
                    <div class="input-group-append">
                        <button type="button" class="browseart btn btn-dark">Przeglądaj..</button>
                    </div>
                </div>
            </div>
        </div>
        <script>

            $(document).on("click", ".browseart", function() {
                var art = $(this).parents().find(".art_file");
                console.log('test');
                art.trigger("click");
            });
            $('.art_file').change(function(e) {
                var fileName = e.target.files[0].name;
                $("#artfile").val(fileName);
            });

            $('#description').keyup(function () {
                var max = 700;
                var len = $(this).val().length;
                if (len > max)
                {
                    $('#charNum').text('Limit znaków: ' + len + ' / 700 znaków  - przekroczyłeś limit!');
                }
                else
                $('#charNum').text('Limit znaków: ' + len + ' / 700 znaków');
            });

        </script>
    </div>

    <div class="row">
        <div class="col-4 p-lg-2">
            <button class="btn btn-info btn-block my-4 mb-2" type="submit">Utwórz wpis</button>
        </div>
    </div>

    <div class="row">
        <div class="col-4 p-lg-2">
            <small class="text-muted">* Pola obowiązkowe</small>
        </div>
    </div>
        </div>

            <div class="col-auto">
                <div class="col-sm-15 p-lg-2">
                    <label for="file">Obraz artykułu*</label>
                    <div class="row" style="margin-left: 0px;">
                    <small class="text-muted">Obraz artykułu musi być plikiem typu jpeg, png, jpg, gif, svg.</small>
                    </div>
                        <input type="file" name="img" class="file custom-file-input" accept="image/gif, image/png, image/jpeg">
                        <div class="input-group my-3">
                            <input type="text" class="form-control custom-file-input" disabled placeholder="Wybierz plik.." id="file">
                            <div class="input-group-append">
                                <button type="button" class="browse btn btn-dark">Przeglądaj..</button>
                                <button type="button" class="d-none remove btn btn-danger">Usuń</button>
                            </div>

                        </div>
                </div>
                <div class="image col-sm-9 p-lg-2">
                    <img src="https://placehold.it/250x250" id="preview" class="img-thumbnail" width="250px" height="250px" >
                </div>
            </div>
        </div>



    </div>
</form>


<script>
    $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('.file').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
        document.getElementById("preview").style.visibility = "visible";
        $('.remove').attr('class', 'remove btn btn-danger')
    });
    $(document).on("click", ".remove", function() {
        document.getElementById("preview").style.visibility = "hidden";
        $('#preview').attr('src', 'https://placehold.it/250x250');
        $('#file').val("Wybierz plik..");
        $('.remove').attr('class', 'd-none remove btn btn-danger');
    });
</script>

<style>

    .file {
        visibility: hidden;
        position: absolute;
    }

    .art_file {
        visibility: hidden;
        position: absolute;
    }

    .image
    {
        margin: 0 20%;
    }

    #preview
    {
        visibility: hidden;
    }
</style>   @endsection