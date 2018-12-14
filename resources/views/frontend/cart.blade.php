@extends('layouts.frontend')

@section('content')

    <section id="shopcart" class="shop shop-cart bg-white">
        <div class="container" style="color: black;">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h1>Your Cart</h1>
                        <div class="cart-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr class="cart-product" style="background-color: white;border-top: 2px solid black;border-bottom: 2px solid black;">
                                    <th class="cart-product-item">Item</th>
                                    <th class="cart-product-item">Description</th>
                                    <th class="cart-product-item">Colour</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-item">Customized</th>
                                    <th class="cart-product-total">Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="cart-product">
                                    <td class="cart-product-item">
                                        <img src="{{ asset('/images/shop/thumb/1.jpg') }}" alt="product"/>
                                    </td>
                                    <td class="cart-product-item">Brave Soul Crew Neck Military Sweater</td>
                                    <td class="cart-product-item">Tan</td>
                                    <td class="cart-product-quantity">
                                        <div class="product-quantity">
                                            <a href="#"><i class="fa fa-minus"></i></a>
                                            <input type="text" value="1" id="pro1-qunt" readonly>
                                            <a href="#"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </td>
                                    <td class="cart-product-item">6 Letters<br/>San Serof, Silver</td>
                                    <td class="cart-product-total">$ 10.00</td>
                                    <td><i class="fa fa-close"></i></td>
                                </tr>
                                <tr class="cart-product">
                                    <td class="cart-product-item">
                                        <img src="{{ asset('/images/shop/thumb/1.jpg') }}" alt="product"/>
                                    </td>
                                    <td class="cart-product-item">Large Tote Bag</td>
                                    <td class="cart-product-item">Tan</td>
                                    <td class="cart-product-quantity">
                                        <div class="product-quantity">
                                            <a href="#"><i class="fa fa-minus"></i></a>
                                            <input type="text" value="1" id="pro1-qunt" readonly>
                                            <a href="#"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </td>
                                    <td class="cart-product-item">6 Letters<br/>San Serof, Silver</td>
                                    <td class="cart-product-total">$ 10.00</td>
                                    <td><i class="fa fa-close"></i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- .row end -->
                
                <div class="row">
                    <!-- Coupon Side -->
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <span>Have a coupon code?</span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <input type="text" class="form-control input-bordered" name="coupon" id="coupon" placeholder="TYPE CODE HERE" style="text-align: center"/>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <button type="submit" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 100%;line-height: 0px; border: 1px solid #282828;">APPLY CODE</button>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 hidden-xs" style="margin-top: -5%;">
                            <hr style="height:1px;border:none;color:#eee;background-color:#eee;" />
                        </div>
                    </div>

                    <!-- Subtotal Side -->
                    <div class="col-xs-12 col-sm-12 col-md-4" style="margin-left: -1%; font-weight: 500;">
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            SUBTOTAL
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6" style="text-align: right;">
                            $160.00 USD
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            SHIPPING
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6" style="text-align: right;">
                            $00.00 USD
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            TAX
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6" style="text-align: right;">
                            $00.00 USD
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 hidden-xs" style="margin-top: -1%;">
                            <hr style="height:1px;border:none;color:#eee;background-color:#eee;" />
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            TOTAL
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6" style="font-size: 14px; text-align: right;" >
                            $160.00 USD
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 hidden-xs" style="margin-top: -3px;">
                            <hr style="height:1px;border:none;color:black;background-color:#333;" />
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            <button type="submit" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 130px;line-height: 0px; border: 1px solid #282828;">CONTINUE SHOPPING</button>
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-6" style="text-align: right;">
                            <button type="submit" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 120px;line-height: 0px; border: 1px solid #282828;">PROCEED</button>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 10px; text-align: justify;">
                            * Note: Shipping and taxes will be updated during checkout
                            based on your billing and shipping information.
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- .container end -->
    </section>
@endsection
