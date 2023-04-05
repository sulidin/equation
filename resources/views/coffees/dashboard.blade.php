@extends('layouts.app')
@php
$activeTab = request()->get('tab', 'inventory');
@endphp
@section('content')
<div class='container mt-5'>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row justify-content-between">
        <div class="align-items-start col-md-8">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item ">
                    <a class="nav-link{{ !$activeTab || $activeTab === 'inventory' ? ' active' : '' }}"
                        href="{{ route('coffees.dashboard', ['tab' => 'inventory']) }}">{{ __('Inventory') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link{{ $activeTab === 'messages' ? ' active' : '' }}"
                        href="{{ route('coffees.dashboard', ['tab' => 'messages']) }}">{{ __('Messages') }}</a>
                </li>
            </ul>
            @if (!$activeTab || $activeTab === 'inventory')
            <a href="{{ route('coffees.create') }}" class="w-100 mb-2 btn btn-outline-dark">{{ __('Add Coffee') }}</a>
            @foreach ($coffees as $coffee)
            <div class="d-sm-flex  justify-content-between align-items-center my-2 pb-3 border-bottom">
                <div class="col-md-6 d-block d-sm-flex text-center text-sm-start">
                    <a class="me-sm-4" href="{{ route('coffees.show', $coffee->id) }}">
                        <img src="{{ asset('images/'.$coffee->pic) }}" width="160" alt="{{ $coffee->name }}">
                    </a>
                    <div>
                        <h3 class="product-title fs-base mb-2">{{ $coffee->name }}</h3>
                        <div class="fs-lg text-accent pt-2">Purchase Price: ${{ $coffee->purchased_price
                            }}.<small>00</small></div>
                        <div class="fs-lg text-accent pt-2">Selling Price: ${{ $coffee->selling_price }}.<small>00</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-end" style="max-width: 9rem;">
                    <label class="form-label" for="quantity1">{{ __('Stock') }}</label>
                    <div class="fs-lg text-accent mb-2">{{ $coffee->stock }}</div>
                    <a href="{{ route('coffees.edit', $coffee->id) }}" class="mb-2 w-100 btn btn-outline-dark">{{ __('Edit')
                        }}</a>
                    <form action="{{ route('coffees.destroy', $coffee->id) }}" method="POST" class="mb-2 w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-100 btn btn-outline-danger">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
            @endforeach
            <div class="col-md-6 text-center">
                {{ $coffees->links() }}
            </div>
            @elseif ($activeTab === 'messages')
            @foreach ($messagess as $message)
            <div class="col mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $message->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $message->email }}</h>
                            <p class="mt-2 card-text">{{ $message->message }}</p>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                <form method="POST" action="{{ route('messages.destroy', $message->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-100 btn btn-outline-danger">{{ __('Delete') }}</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-6 text-center">
                {{ $messagess->links() }}
            </div>
            @endif
        </div>

        <div class="col-md-4 pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-sm-end" style="max-width: 300px;">
            <h4 class="mb-5">Earnings</h4>
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <h1 class="card-title text-accent">${{ $yearlyEarnings }}.<small>00</small></h1>
                    <p class="card-text text-uppercase mb-0">Yearly</p>
                    <p class="card-subtext" style="font-size: 0.7rem;">Total earnings for the current year, providing an
                        overview of how much profit your coffee business has made over the past 12 months.</p>
                </div>
            </div>
            <div class="card bg-light text-dark mt-3">
                <div class="card-body">
                    <h1 class="card-title text-accent">${{ $monthlyEarnings }}.<small>00</small></h1>
                    <p class="card-text text-uppercase mb-0">Monthly</p>
                    <p class="card-subtext" style="font-size: 0.7rem;">Total earnings for the current month, giving you a
                        more detailed picture of your coffee business's performance on a month-to-month basis.</p>

                </div>
            </div>
            <div class="card bg-light text-dark mt-3">
                <div class="card-body">
                    <h1 class="card-title text-accent">${{ $dailyEarnings }}.<small>00</small></h1>
                    <p class="card-text text-uppercase mb-0">Daily</p>
                    <p class="card-subtext" style="font-size: 0.7rem;">Snapshot of your coffee business's performance for
                        the day, showing you how much profit you've made so far today and helping you track your progress
                        toward your daily sales goals.</p>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection