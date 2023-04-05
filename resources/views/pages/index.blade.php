@extends('layouts.app')

@section('content')

<!-- Hero section -->
<section class="hero d-flex align-items-center text-dark py-5 " style="background-image: url('{{ asset('storage/images/Artboard.png') }}'); background-size: cover; background-position: center; height: 80vh;">
  <div class="container">
    <div class="row justify-content-end text-end">
      <div class="col-md-6">
        <h1 class="display-4">EQUATION</h1>
        <p class="lead" style="font-size: 1rem;">We're passionate about coffee and dedicated to roasting the perfect bean. We believe that every cup of coffee should be an experience - one that tantalizes the taste buds and invigorates the senses.</p>
        <a href="/shop" class="mb-2 btn btn-outline-dark">Shop Now</a>
      </div>
    </div>
  </div>
</section>
<div class='container mt-5 border-top text-center' >
    <section class="about py-5 "style="background-image: url('{{ asset('storage/images/index.png') }}'); background-size: cover; background-position: center; height: 60vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>About Us</h2>
                    <p>Equation Coffee Roaster was founded in 2010 with a simple goal: to roast and serve the best coffee in town. Our beans are sourced from the finest coffee-growing regions around the world, and are carefully roasted in small batches to ensure maximum flavor and aroma.</p>
                    <p>Equation Coffee Roaster is not just committed to producing the best coffee possible, but also to doing so in an environmentally responsible way. We believe that sustainability is key to the future of coffee farming, and we take our role in promoting sustainable practices very seriously.</p>
                    <p>But we're more than just a coffee roaster. We're a community of coffee lovers, and we're dedicated to sharing our passion with the world. Whether you're a seasoned coffee drinker or just discovering the joys of a good cup of joe, we're here to help you find the perfect blend.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- About section -->

<section>
        <div class="row border-top">
            <h2 class="mt-5">Popular Beans</h2>
            @forelse ($coffees->shuffle()->slice(0, 4) as $coffee)
        <div class="col-md-3 mb-3 mt-5">
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
        <p>We have no coffee left in the stock at the moment.</p>
    @endforelse
    </div>


</section>

</div>

@endsection