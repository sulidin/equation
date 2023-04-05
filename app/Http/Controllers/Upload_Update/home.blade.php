@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                        <p>User View HERE</p>
                    {{ __('You are logged in!') }}
                    <!--displaying grid coffee card-->
                    <div>
                          <table class="table table-striped">
                              <tr><th>Icon</th>
                              <th>Coffee Name</th>
                              <th>Description</th>
                              <th>Selling Price</th>
                              <th>Purchased Price</th><th>FORM ACTION</th></th></tr>
                               @foreach ($coffees as $coffee)
                              <tr>
                                 <td><img src="{{asset('/images/'.$coffee->pic)}}" alt="image" height="60px" width="60px" style="border-radius:15px;"></td>
                            
                                <td>{{ $coffee->name }}</td>
                                <td>{{ $coffee->description }}</td>
                                <td>{{ $coffee->selling_price }}</td>
                                <td>{{ $coffee->purchased_price }}</td>
                                <td><a href="{{route('coffees.show',$coffee->id)}}" >More Details...</a></td>
                                 
                              </tr><br>
                              @endforeach
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
