@extends('layouts.app')

@section('content')
<div class='container mt-5'style="background-image: url('{{ asset('storage/images/login.png') }}'); background-size: cover; background-position: center; height: 80vh;">
    <main class="form-signin m-auto">
        <div class="container col-sm-8 col-lg-4 text-center ">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Register</h1>
                <div class="form-floating">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <label for="floatingInput">{{ __('Name') }}</label>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">
                    <label for="floatingInput">{{ __('Email Address') }}</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    <label for="floatingPassword">{{ __('Password') }}</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">
                    <label for="floatingPassword">{{ __('Confirm Password') }}</label>
                </div>

                <button class="mt-5 w-100 btn btn-outline-dark" type="submit">{{ __('Register') }}</button>
                <p class="mt-5 mb-3 text-muted">© EQ–2023</p>
            </form>
        </div>
    </main>
</div>
@endsection