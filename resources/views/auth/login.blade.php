@extends('layouts.app')

@section('content')
<div class='container mt-5'style="background-image: url('{{ asset('storage/images/login.png') }}'); background-size: cover; background-position: center; height: 80vh;">
    <main class="form-signin m-auto">
        <div class="mt-5 container col-sm-8 col-lg-4 text-center ">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h1 class="h3 mb-3 fw-normal">EQ</h1>

                <div class="form-floating">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="floatingPassword">{{ __('Email Address') }}</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    <label for="floatingPassword">{{ __('Password') }}</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="checkbox mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                            ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <button class="w-100 btn btn-outline-dark" type="submit">{{ __('Login') }}</button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
                <p class="mt-5 mb-3 text-muted">© EQ–2023</p>
            </form>
        </div>
    </main>
</div>
@endsection