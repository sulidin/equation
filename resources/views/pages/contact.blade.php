@extends('layouts.app')

@section('content')
<div class='container mt-5' style="background-image: url('{{ asset('storage/images/contact.png') }}'); background-size: cover; background-position: center; height: 80vh;">
    <div class="row justify-content-center text-center">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <h1 class="mb-5">Contact Us</h1>
        <div class="col-md-6">
            <p>We love hearing from our customers! If you have any questions, comments, or concerns, please feel free to get
                in touch with us!</p>
            <div class="card-body">
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <div class="form-floating">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name')}}" required autocomplete="name" autofocus>
                        <label for="floatingPassword">{{ __('Name') }}</label>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email')}}" required autocomplete="email" autofocus>
                        <label for="floatingPassword">{{ __('Email') }}</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <textarea id="message" style="min-height: 150px;"
                            class="col-form-label form-control @error('message') is-invalid @enderror" name="message"
                            value>{{ old('description')}}</textarea>

                        <label for="floatingPassword">{{ __('Your Message') }}</label>
                        @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn w-100 btn-outline-dark">{{ __('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection