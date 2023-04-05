@extends('layouts.app')

@section('content')
<div class='container mt-5'>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(count($cart) == 0)
    <div class="alert alert-info">
        Your cart is empty!
    </div>
    @else
    <div class="row">
        <div class="row align-items-start col-md-8 border-end" style="padding-right: 50px !important;">
            @php
            $total = 0;
            $shippingfee =10;

            @endphp

            @foreach ($cart as $id => $item)
            <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
                <div class="col-md-6 d-block d-sm-flex text-center text-sm-start">
                    <a class="me-sm-4" href="{{ route('coffees.show', $id) }}">
                        @if(isset($item['pic']))
                        <img src="{{ asset('images/' . $item['pic']) }}" width="160" alt="{{ $item['name'] }}"
                            class="rounded">
                        @endif

                    </a>
                    <div>
                        <h3 class="product-title fs-base mb-2">{{ $item['name'] }}</h3>
                        <div class="fs-lg text-accent pt-2">Price: ${{ $item['price'] }}.<small>00</small></div>
                    </div>
                </div>
                <div class=" col-md-4 pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-end "
                    style="max-width: 10rem;">
                    <form action="{{ route('cart.changeQuantity', ['id' => $id]) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="number" class="form-control" name="quantity" value="{{ $item['quantity'] }}"
                                min="1" max="10">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>

                    <td>
                        <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                            @csrf
                            <button class="w-100 btn btn-outline-danger" type="submit">Remove</button>
                        </form>
                    </td>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-5">
                <h3 class="product-title fs-base mb-2">Subtotal</a></h3>
                <div class="fs-lg text-accent pt-2 text-sm-end"><small>CAD</small> ${{ $item['price'] * $item['quantity']
                    }}.<small>00</small></div>
            </div>
            @php
            $total += $item['price'] * $item['quantity'];
            @endphp

            @endforeach
        </div>
        <div class="col-md-4">
            <div class="ps-4">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Order Summary</h5>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Subtotal</span>
                    <span>${{ $total }}.00</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Shipping Fee</span>
                    <span>${{ $shippingfee }}.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <h5>Total</h5>
                    <div class="fs-lg text-accent text-sm-end" style="font-size: 24px;">
                        <abbr style="font-size: 0.7rem;">CAD</abbr> ${{ $total+$shippingfee }}.<small>00</small>
                    </div>
                </div>
                <div class="mt-5">
                    <h5 class="mb-3">Shipping Address</h5>
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="Name" id="name" placeholder="First Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="lastname" id="lastname"
                                        placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Address"
                                required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="city" id="city" placeholder="City"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="province" id="province"
                                        placeholder="Province" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code" required>
                        </div>
                        <button type="submit" class="btn btn-outline-dark w-100 mb-3">Checkout</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endif

@endsection