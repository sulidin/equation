@extends('layouts.app')

@section('content')
<div class='container mt-5 text-center'>
    <h1>Coffee Shop</h1>

    <div class="container mt-5">
        <div class="row">


            @forelse ($coffees as $coffee)

            <div class="col-md-3 mb-3">
                <div class="card p-0">
                    <a href="{{ route('coffees.show', $coffee->id) }}">
                        <img src="{{ asset('images/'.$coffee->pic) }}" class="card-img-top" alt="{{ $coffee->name }}">
                    </a>
                    <div class="m-2 text-center">
                        <h5 class="card-title text-uppercase">{{ $coffee->name }}</h5>
                        <p class="card-text">${{ $coffee->selling_price }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p>You have no coffee left in the stock at the moment.</p>
            @endforelse

        </div>
    </div>
     <div class="row">
    <div class="col-md-6 text-center">
        {{ $coffees->links() }}
    </div>
</div>
</div>

@endsection