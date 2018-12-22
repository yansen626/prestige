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
                            <input type="radio" name="credit_card" id="credit_card" placeholder="STREET"/> Pay with Credit Card
                            <input type="radio" name="transfer" id="transfer" placeholder="STREET"/> Pay with Transfer
                        </div>

                        <div class="col-md-12">
                            <select name="card_type" id="card_type" class="form-control">
                                <option value="-1" selected>CARD TYPE</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="holder_name" id="holder_name" placeholder="CARD HOLDER NAME" required/>
                            @if ($errors->has('holder_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('holder_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="card_number" id="card_number" placeholder="CARD NUMBER" required/>
                            @if ($errors->has('card_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('card_number') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="card_date" id="card_date" placeholder="MM/YY" maxlength="5" required />
                            @if ($errors->has('card_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('card_date') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <input type="number" class="form-control" name="card_cvv" id="card_cvv" placeholder="CVV" maxlength="3"  pattern="\d{4}" required/>
                            @if ($errors->has('card_cvv'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('card_cvv') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-12 col-md-6">
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            <input type="radio" name="another_shipment" value="ship" class=""/> I've read and accept the T&C's
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
                                <table class="table">
                                    <tr>
                                        <td rowspan="2" align="center">
                                            <img src="{{ asset('/images/shop/thumb/1.jpg') }}" alt="product"/>
                                        </td>
                                        <td width="15%">
                                            PRODUCT
                                        </td>
                                        <td style="text-align: right;">
                                            TOTAL
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="word-wrap:break-word;">
                                            Large Tote Bag, Tan
                                            Customized (LRM)
                                            San Serif, Silver,
                                            1x
                                        </td>
                                        <td style="text-align: right;">
                                            $80.00 USD
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="2" align="center">
                                            <img src="{{ asset('/images/shop/thumb/1.jpg') }}" alt="product"/>
                                        </td>
                                        <td width="50%">
                                            PRODUCT
                                        </td>
                                        <td style="text-align: right;">
                                            TOTAL
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="word-wrap:break-word;">
                                            Large Tote Bag, Tan
                                            Customized (LRM)
                                            San Serif, Silver,
                                            1x
                                        </td>
                                        <td style="text-align: right;">
                                            $80.00 USD
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table" style="border: none;">
                                    <tr style="border: none;">
                                        <td colspan="2">SHIPPING TO</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="word-wrap:break-word;">
                                            Name, Number, Street Address,
                                            Suburb, Postcode, State, Country
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr/></td>
                                    </tr>
                                    <tr>
                                        <td>SUBTOTAL</td>
                                        <td align="left">$160.00 USD</td>
                                    </tr>
                                    <tr>
                                        <td>SHIPPING</td>
                                        <td align="left">$10.00 USD</td>
                                    </tr>
                                    <tr>
                                        <td>TAX</td>
                                        <td align="left">$00.00 USD</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr/></td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL</td>
                                        <td align="left">$170.00 USD</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </form>
    </section>
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