@extends('layouts.frontend')

@section('pageTitle', 'Order | NAMA')
@section('content')

    <!-- DESKTOP -->
    <section id="shopcart" class="shop shop-cart bg-white hidden-sm hidden-xs">
        <div class="container" style="color: black;">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h1>Your Order List</h1>
                        <div class="cart-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr class="cart-product" style="background-color: white;border-top: 2px solid black;border-bottom: 2px solid black;">
                                    <th class="cart-product-item">Date</th>
                                    <th class="cart-product-item">Order Number</th>
                                    <th class="cart-product-item">Shipping</th>
                                    <th class="cart-product-item">Subtotal</th>
                                    <th class="cart-product-item">Tax Amount</th>
                                    <th class="cart-product-total">Grand Total</th>
                                    <th class="cart-product-total">Status</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($orders != null)
                                    @foreach($orders as $order)
                                        <tr class="cart-product">
                                            <td class="cart-product-item">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('j F Y')}}
                                            </td>
                                            <td class="cart-product-item">
                                                {{$order->order_number}}
                                            </td>
                                            <td class="cart-product-item">
                                                {{$order->shipping_option}}
                                            </td>
                                            <td class="cart-product-item">
                                                {{env('KURS_IDR')}} {{$order->sub_total_string}}
                                            </td>
                                            <td class="cart-product-item">
                                                {{env('KURS_IDR')}} {{$order->tax_amount_string}}
                                            </td>
                                            <td class="cart-product-item">
                                                {{env('KURS_IDR')}} {{$order->grand_total_string}}
                                            </td>
                                            <td class="cart-product-item">
                                                {{$order->order_status->name}}
                                            </td>
                                            <td>
                                                @if($order->order_status_id == 2)
                                                    <a href="{{route('checkout', ['order'=>$order->id])}}">
                                                        <button type="button" class="btn btn--primary btn--bordered custom-btn">Pay</button>
                                                    </a>
                                                @else
                                                    <a href="{{route('order.detail', ['order'=>$order->id])}}">
                                                        <button type="button" class="btn btn--secondary custom-btn">Detail</button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- .row end -->

        </div><!-- .container end -->
    </section>

    <!-- MOBILE -->
    <section id="shopcart" class="shop shop-cart bg-white hidden-md hidden-lg">
        <div class="container" style="color: black;">
                <div class="row">
                    <h1>Your Cart</h1>
                            @foreach($orders as $order)
                                {{--<div class="col-xs-12 col-sm-12 col-md-12 border-b">--}}
                                    {{--<div class="col-xs-6 col-sm-6">--}}
                                        {{--<img src="{{ asset('/images/shop/thumb/1.jpg') }}" alt="product" style="width: 100%;"/>--}}

                                        {{--<i class="fa fa-close delete" data-toggle="modal" data-id="{{ $cart->id }}" data-target="#myModal"></i>--}}
                                        {{--<input type="hidden" value="{{ $cart->price }}" id="price{{ $cart->id }}">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-6 col-sm-6">--}}
                                        {{--{{ $cart->product->name }}, {{ $cart->product->colour }}--}}
                                        {{--<input type="hidden" name="id[]" value="{{ $cart->id }}"/>--}}
                                        {{--<br>--}}
                                        {{--{!! $cart->description  !!}--}}

                                        {{--<br>--}}
                                        {{--TOTAL<br>--}}
                                        {{--<span id="total_price{{ $cart->id }}">{{ $cart->total_price }} </span>--}}

                                        {{--<div class="product-quantity">--}}
                                            {{--<a><i class="fa fa-minus" onclick="updateQty('{{ $cart->id }}', 'min')"></i></a>--}}
                                            {{--<input type="text" value="{{ $cart->qty }}" id="qty{{ $cart->id }}" name="qty[{{ $cart->id }}]" readonly>--}}
                                            {{--<a><i class="fa fa-plus" onclick="updateQty('{{ $cart->id }}', 'plus')"></i></a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            @endforeach
                </div><!-- .row end -->

        </div><!-- .container end -->
    </section>

@endsection

@section('styles')
    <style>
        .custom-btn{
            font-size: 11px;
            line-height: 29px;
            width: 100px;
            height: 30px;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">
    </script>
@endsection
