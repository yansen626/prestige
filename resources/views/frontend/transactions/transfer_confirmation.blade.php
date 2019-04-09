@extends('layouts.frontend')

@section('pageTitle', 'Transfer Confirmation | NAMA')
@section('content')
    <section class="bg-white">
            <div class="container">
                <div class="row" style="margin-bottom:5%;">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12">
                            <h1>Order {{$order->order_number}}</h1>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                            <br/>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                                <div class="col-md-12 text--center">
                                    <p>
                                        We are pleased to tell you your order has been received.<br>
                                        Please make the payment to the account stated below.<br>
                                    </p>
                                    <h4>
                                        Bank Central Asia<br>
                                        123 456 7890 a.n Nama-official
                                    </h4>
                                    <p>TOTAL PAYMENT = {{env('KURS_IDR')}} {{$order->grand_total_string}}</p>
                                </div>
                                <div class="col-md-12">
                                    <h1>Confirm Payment</h1>
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

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="account_no" id="account_no" value="{{old('account_no')}}" placeholder="ACCOUNT NUMBER" required/>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="account_name" id="account_name" value="{{old('account_name')}}" placeholder="ACCOUNT NAME" required/>
                                </div>

                                <div class="col-md-12">
                                    <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="PASSWORD" required/>
                                </div>

                                <div class="col-md-12 center">
                                    <button type="submit" class="btn btn--secondary btn--bordered">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="col-md-12">
                                    <div class="col-md-7 border-bottom-black mb-20">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4">PRODUCT</div>
                                        <div class="col-md-2">QUANTITY</div>
                                        <div class="col-md-4 right">TOTAL</div>
                                    </div>
                                    <div class="col-md-5 border-bottom-black mb-20 hidden-xs hidden-sm">
                                        SHIPPING TO
                                    </div>
                                    <hr class="hidden-xs hidden-sm" style="height:1px;border:none;color:#333;background-color:#333;" />
                                    <div class="col-md-7">
                                        @foreach($orderProduct as $product)
                                            <div class="col-md-12 mb-10">
                                                <div class="col-md-2 ">
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
                                                    {{env('KURS_IDR')}} {{$product->grand_total_string}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-md-12 border-bottom-black mb-20 hidden-md hidden-lg">
                                            SHIPPING TO
                                        </div>
                                        <div class="col-md-12 border-bottom-black mb-20">
                                            {{$order->address->description}}, {{$order->address->street}},
                                            {{$order->address->suburb}}, {{$order->address->postal_code}}, {{$order->address->state}}, {{$order->address->country->name}},
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SUBTOTAL</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->sub_total_string}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SERVICE</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->payment_charge_string}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold">SHIPPING</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->shipping_charge_string}}</div>
                                        </div>
                                        <div class="col-md-12 border-bottom-black mb-20">
                                            <div class="col-md-6 bold">TAX</div>
                                            <div class="col-md-6 right">{{env('KURS_IDR')}} {{$order->tax_amount_string}}</div>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <div class="col-md-6 bold"><h5>TOTAL</h5></div>
                                            <div class="col-md-6 right bold"><h5>{{env('KURS_IDR')}} {{$order->grand_total_string}}</h5></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
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