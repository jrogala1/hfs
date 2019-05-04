@extends('templates.template')
<link href="css/bootstrap/login.css" rel="stylesheet">
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ __('Logowanie') }}</h5>
                        <form method="POST" class="form-signin" action="{{ route('login') }}">
                        @csrf
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" required autofocus>
                                <label for="inputEmail">{{ __('Email') }}</label>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <label for="inputPassword">{{ __('Hasło') }}</label>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="customCheck1"  {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheck1">{{ __('Pamiętaj e-mail') }}</label>
                            </div>
                            <div>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">{{ __('Zaloguj się') }}</button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Zapomniałeś hasła?') }}
                                    </a>
                                @endif
                            </div>
                            <hr class="my-4">
                            <div>Nie masz konta? <a href="{{url('/register')}}">Zarejestruj się</a> już teraz!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')