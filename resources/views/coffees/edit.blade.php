@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6 ">
            <h3 class="card-title text-center mb-3">{{ __('Edit Coffee Item') }}</h3>
            <div class="card">

                <div class="card-header">

                    <a href="{{ route('coffees.dashboard') }}" class="text-dark float-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path
                                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg>
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('coffees.update', $coffee->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-floating">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $coffee->name) }}" required autocomplete="name"
                                autofocus>
                            <label for="floatingPassword">{{ __('Name') }}</label>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <textarea id="description" style="min-height: 150px;"
                                class="col-form-label form-control @error('description') is-invalid @enderror"
                                name="description" value>{{ old('description', $coffee->description) }}</textarea>

                            <label for="floatingPassword">{{ __('Description') }}</label>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input id="stock" type="number"
                                class=" col-form-label form-control @error('stock') is-invalid @enderror" name="stock"
                                value="{{ old('stock', $coffee->stock) }}" required autocomplete="stock" autofocus>
                            <label for="floatingPassword">{{ __('Stock') }}</label>
                            @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input id="selling_price" type="number"
                                class=" col-form-label form-control @error('selling_price') is-invalid @enderror"
                                name="selling_price" value="{{ old('selling_price', $coffee->selling_price) }}" required
                                autocomplete="selling_price" autofocus>
                            <label for="number">{{ __('Selling Price') }}</label>
                            @error('selling_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input id="purchased_price" type="number"
                                class=" col-form-label form-control @error('purchased_price') is-invalid @enderror"
                                name="purchased_price" value="{{ old('purchased_price', $coffee->purchased_price) }}"
                                required autocomplete="purchased_price" autofocus>
                            <label for="number">{{ __('Purchased Price') }}</label>
                            @error('purchased_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3 mb-2">
                            <label for="formFile" class="form-label">Upload Item Photo</label>
                            <input class="form-control @error('pic') is-invalid @enderror" type="file" id="pic"
                                name="pic">
                            @error('pic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">

                            <button type="submit" class="btn w-100 btn-outline-dark">
                                {{ __('Save') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection