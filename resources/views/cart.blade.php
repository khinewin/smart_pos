@extends('layout.auth.app')

@section('my_title') Shopping Cart @stop

@section('my_content')

    @include('partials.frontend.navbar')

    <div class="container pt-2 pb-5">
        <div class="row">
            <div class="col-sm-8">
                <h5><i class="fas fa-shopping-cart"></i> Shopping Cart</h5>
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-borderless table-hover small">
                            <tr>
                                <th>Item Name</th>
                                <th>Price (MMK)</th>
                                <th>Qty</th>
                                <th>Amount (MMK)</th>
                            </tr>

                            @if(Session::has('cart'))

                                @foreach(Session::get('cart')->items as $i)
                                    <tr>
                                        <td>{{$i['item']['item_name']}}</td>
                                        <td>{{$i['item']['price']}}</td>
                                        <td>
                                            <a href="{{route('decrease.cart',['id'=>$i['item']['id']])}}"><i class="fas fa-minus-circle"></i></a>
                                            {{$i['qty']}}
                                            <a href="{{route('increase.cart',['id'=>$i['item']['id']])}}"><i class="fas fa-plus-circle"></i></a>
                                        </td>
                                        <td>{{$i["amount"]}}</td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td colspan="3" class="text-right">Total Qty</td>
                                    <td>{{Session::get('cart')->totalQty}}</td>
                                </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Total Amount</td>
                                        <td>{{Session::get('cart')->totalAmount}}</td>
                                    </tr>

                                @else
                                <tr>
                                    <td colspan="4">
                                        <div class="text-center text-info small">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            No shopping items.
                                        </div>
                                    </td>
                                </tr>
                                @endif
                        </table>
                    </div>
                </div>
                <div class="mt-3 small">
                    <a href="{{route('/')}}"><i class="fas fa-shopping-basket"></i> Continued shopping.</a>
                    <a href="{{route('clear.cart')}}" class="btn btn-link text-danger float-right"> <i class="fas fa-times-circle"></i> Clear Cart</a>
                </div>
            </div>
            <div class="col-sm-4">
                @if(Session::has('cart'))
                    <h5>Additional information.</h5>
                    <div class="card shadow">
                        <div class="card-body">
                            @if(Auth::User())

                                <form method="post" action="{{route('checkout')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" name="phone" id="phone" class="form-control">
                                        @if($errors->has('phone')) <span class="text-danger">{{$errors->first('phone')}}</span> @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Checkout</button>
                                    </div>
                                </form>

                                @else
                                <p>
                                    Please signin <a href="{{route('login')}}">Here</a> to our website to contined checkout.
                                </p>
                            @endif
                        </div>
                    </div>

                    @endif
            </div>
        </div>
    </div>
@stop

