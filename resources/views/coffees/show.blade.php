@extends('layouts.app')

@section('content')
<div class='container mt-5'>
    @if(Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @endif

    <div class="px-4 py-lg-4 py-3 mb-5">
        <div class="py-lg-3 py-2 px-lg-3">
            <div class="row gy-4">
                <!-- Product image-->
                <div class="col-lg-6">
                    <a href="{{ route('coffees.show', $coffee->id) }}">
                        <img src="{{ asset('images/'.$coffee->pic) }}" class="card-img-top rounded"
                            alt="{{ $coffee->name }}">
                    </a>
                </div>
                <!-- Product details-->
                <div class="col-lg-6">
                    <div class="ps-xl-5 ps-lg-3">
                        <h2 class="h3 mb-3 text-uppercase">{{ $coffee->name }}</h2>
                        <!-- Description-->
                        <p class="mb-4 pb-md-2 fs-sm">{{ \Illuminate\Support\Str::limit($coffee->description, 1000) }}</p>
                        <div class="mt-auto">
                            <div class="row row-cols-sm-2 row-cols-1 gy-3 mb-4 pb-md-2">
                                <div class="col">
                                    <h3 class="h6 mb-2 fs-sm text-muted">Price</h3>
                                    <h2 class="h3 mb-1">${{ $coffee->selling_price }}</h2>
                                </div>
                            </div>
                            <form action="{{ route('cart.add', $coffee->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-100 btn btn-outline-dark">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection