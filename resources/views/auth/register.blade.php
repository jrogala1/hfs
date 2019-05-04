@extends('templates.template')

@section('content')

    <link href="css/bootstrap/register.css" rel="stylesheet">


    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Rejestracja</h5>
                        <form class="form-signin" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-label-group">
                                <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="login" required>
                                <label for="name">{{ __('Imię') }}</label>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-label-group">
                                <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
                                <label for="password">{{ __('Hasło') }}</label>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-label-group">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Password" required>
                                <label for="password_confirmation">{{ __('Powtórz hasło') }}</label>
                            </div>

                            <div class="form-label-group">
                                <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" required>
                                <label for="email">{{ __('Adres email') }}</label>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">{{ __('Utwórz konto') }}</button>
                            <hr class="my-4">
                            <div>Masz już konto? <a href="{{ route('login') }}">{{ __('Zaloguj się') }}</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')