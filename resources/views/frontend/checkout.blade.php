@extends('layouts.frontend')

@section('content')
    <section class="bg-white">
        <form method="POST" action="#">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12">
                            <h1>Checkout</h1>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                            <br/>
                        </div>
                        <div class="col-md-12">
                            @foreach($errors->all() as $error)
                                <span class="form-message">
                                    <strong> {{ $error }} </strong>
                                    <br/>
                                </span>
                            @endforeach
                        </div>

                        @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                            {{--Check if logged in and there's payment Info--}}
                        @endif

                        <div class="col-md-6">
                            <input type="radio" name="payment_method" id="cc"/>
                            <img src="{{ asset('images/icons/nama-brand-pinterest.svg') }}" class="width-50">
                            {{--Pay with Credit Card--}}
                            &nbsp;
                            <input type="radio" name="payment_method" id="va"/>
                            <img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-50">
                            {{--Pay with Virtual Account--}}
                            &nbsp;
                            <input type="radio" name="payment_method" id="bank"/>
                            <img src="{{ asset('images/icons/nama-brand-facebook.svg') }}" class="width-50">
                            {{--Pay with Transfer Bank--}}
                        </div>

                        {{--<div class="col-md-12">--}}
                            {{--<select name="card_type" id="card_type" class="form-control">--}}
                                {{--<option value="-1" selected>CARD TYPE</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12">--}}
                            {{--<input type="text" class="form-control" name="holder_name" id="holder_name" placeholder="CARD HOLDER NAME" required/>--}}
                            {{--@if ($errors->has('holder_name'))--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                    {{--<strong>{{ $errors->first('holder_name') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12">--}}
                            {{--<input type="text" class="form-control" name="card_number" id="card_number" placeholder="CARD NUMBER" required/>--}}
                            {{--@if ($errors->has('card_number'))--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                    {{--<strong>{{ $errors->first('card_number') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}

                        {{--<div class="col-md-6">--}}
                            {{--<input type="text" class="form-control" name="card_date" id="card_date" placeholder="MM/YY" maxlength="5" required />--}}
                            {{--@if ($errors->has('card_date'))--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                    {{--<strong>{{ $errors->first('card_date') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}

                        {{--<div class="col-md-6">--}}
                            {{--<input type="number" class="form-control" name="card_cvv" id="card_cvv" placeholder="CVV" maxlength="3"  pattern="\d{4}" required/>--}}
                            {{--@if ($errors->has('card_cvv'))--}}
                                {{--<span class="invalid-feedback" role="alert">--}}
                                    {{--<strong>{{ $errors->first('card_cvv') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="row border">
                    <div class="col-xs-6 col-sm-12 col-md-6">
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            <input type="checkbox" name="TC_Aggrement" value="ship" class=""/> I've read and accept the T&C's
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-12 col-md-6">
                        <div class="col-xs-6 col-sm-12 col-md-12" style="text-align: right;">
                            <button type="submit" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 120px;line-height: 0px; border: 1px solid #282828;">PAY NOW</button>
                        </div>
                    </div>
                </div>

                <br/>

                <div class="row">
                    <table class="table">
                        <tr>
                            <td colspan="2">REVIEW YOUR ORDER</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="col-md-12">
                                    <div class="col-md-7 border-bottom-black mb-20">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">PRODUCT</div>
                                        <div class="col-md-2">QUANTITY</div>
                                        <div class="col-md-4 right">TOTAL</div>
                                    </div>
                                    <div class="col-md-5 border-bottom-black mb-20">
                                        SHIPPING TO
                                    </div>
                                    <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                    <div class="col-md-7">
                                        @foreach($orderProduct as $product)
                                            <div class="col-md-12 mb-10">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('/images/shop/thumb/1.jpg') }}" alt="product"/>
                                                </div>
                                                <div class="col-md-4">
                                                    {{$product->product->name}}
                                                    Customized :<br>
                                                    {!! $product->product_info !!}
                                                </div>
                                                <div class="col-md-2">
                                                    {{$product->qty}}
                                                </div>
                                                <div class="col-md-4 right">
                                                    {{$product->grand_total}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-md-12 border-bottom-black mb-20">
                                            {{$order->address->description}}, {{$order->address->street}},
                                            {{$order->address->suburb}}, {{$order->address->postal_code}}, {{$order->address->state}}, {{$order->address->country->name}},
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SUBTOTAL</div>
                                            <div class="col-md-6 right">{{$order->sub_total}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SERVICE</div>
                                            <div class="col-md-6 right">{{$order->payment_charge}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SHIPPING</div>
                                            <div class="col-md-6 right">{{$order->shipping_charge}}</div>
                                        </div>
                                        <div class="col-md-12 border-bottom-black mb-20">
                                            <div class="col-md-6 bold">TAX</div>
                                            <div class="col-md-6 right">{{$order->tax_amount}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold"><h5>TOTAL</h5></div>
                                            <div class="col-md-6 right bold"><h5>{{$order->grand_total}}</h5></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('styles')
    <style>
        .border-bottom-black {
            border-bottom: 1px solid #000000 !important;
            padding-bottom: 10px;
        }
        .right{
            text-align: right;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">
        //Set input Restriction
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    }
                });
            });
        }

        setInputFilter(document.getElementById("card_date"), function(value) {
            return /^-?\d*[/,]?\d*$/.test(value); });

        $('#card_date').on('input', function() {
            var tmp = $(this).val();
            if(tmp.length === 2){
                $(this).val(tmp + '/');
            }
        });
    </script>
@endsection