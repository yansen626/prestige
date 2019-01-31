@extends('layouts.frontend')

@section('content')
    <section class="bg-white">
        <form method="POST" action="{{ route('submit.billing') }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12">
                            <h1>Billing & Shipping</h1>
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
                        <input type="hidden" name="weight" value="{{$totalWeight}}">
                        {{-- guset or user don't have address --}}
                        @if($flag==0)
                            <div>
                                <div class="col-md-12">
                                    <select name="country" id="country" class="form-control">
                                        <option value="-1" selected>COUNTRY/REGION</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <select name="province" id="province" class="form-control">
                                        <option value="-1" selected>PROVINCE</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <select name="city" id="city" class="form-control">
                                        <option value="-1" selected>CITY</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->province_id . '-' . $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address_detail" id="address_detail"
                                           placeholder="HOUSE/APARTMENT/UNIT NUMBER" value="{{old('address_detail')}}" required/>
                                    @if ($errors->has('address_detail'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address_detail') }}</strong>
                                </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="street" id="street"
                                           placeholder="STREET" value="{{old('street')}}" required/>
                                    @if ($errors->has('street'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('street') }}</strong>
                                </span>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="suburb" id="suburb"
                                           placeholder="SUBURB" value="{{old('suburb')}}" required/>
                                    @if ($errors->has('suburb'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('suburb') }}</strong>
                                </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="post_code" id="post_code"
                                           placeholder="POST CODE" value="{{old('post_code')}}" required/>
                                    @if ($errors->has('post_code'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('post_code') }}</strong>
                                </span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="state" id="state"
                                           placeholder="STATE" value="{{old('state')}}" required/>
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        {{-- guset or user already have address --}}
                        @else
                            <div>
                                <div class="col-md-12">
                                    <h4>Country : {{$address->country->name}}</h4>
                                    <input type="hidden" name="country" value="{{$address->country_id}}">
                                </div>

                                <div class="col-md-12">
                                    <h4>Province : {{$address->province->name}}</h4>
                                    <input type="hidden" name="province" value="{{$address->province_id}}">
                                </div>

                                <div class="col-md-12">
                                    <h4>City : {{$address->city->name}}</h4>
                                    <input type="hidden" name="city" value="{{$address->city_id}}">
                                </div>

                                <div class="col-md-12">
                                    <h4>{{$address->description}}, {{$address->street}}</h4>
                                    <input type="hidden" name="address_detail" value="{{$address->description}}">
                                    <input type="hidden" name="street" value="{{$address->street}}">
                                </div>

                                <div class="col-md-6">
                                    <h4>Suburb : {{$address->suburb}}</h4>
                                    <input type="hidden" name="suburb" value="{{$address->suburb}}">
                                </div>

                                <div class="col-md-6">
                                    <h4>Post Code : {{$address->postal_code}}</h4>
                                    <input type="hidden" name="post_code" value="{{$address->postal_code}}">
                                </div>

                                <div class="col-md-6">
                                    <h4>State : {{$address->state}}</h4>
                                    <input type="hidden" name="state" value="{{$address->state}}">
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Input new Address --}}
                <div id="new-address" style="display:none;">
                    <div class="col-md-12">
                        <h1>New Shipping Address</h1>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                        <br/>
                    </div>
                    <div class="col-md-12">
                        <select name="country_secondary" id="country" class="form-control">
                            <option value="-1" selected>COUNTRY/REGION</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <select name="province_secondary" id="province" class="form-control">
                            <option value="-1" selected>PROVINCE</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <select name="city_secondary" id="city" class="form-control">
                            <option value="-1" selected>CITY</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->province_id . '-' . $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address_detail_secondary" id="address_detail" placeholder="HOUSE/APARTMENT/UNIT NUMBER" />
                    </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="street_secondary" id="street" placeholder="STREET" />
                    </div>

                    <div class="col-md-12">
                        <input type="text" class="form-control" name="suburb_secondary" id="suburb" placeholder="SUBURB" />
                    </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="post_code_secondary" id="post_code" placeholder="POST CODE" />
                    </div>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="state_secondary" id="state" placeholder="STATE" />
                    </div>
                </div>

                <div class="row padding-top-3">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            @if($flag==0)
                                &nbsp;
                            @else
                                <input type="checkbox" name="another_shipment" id="another_shipment" class=""/> Ship to a different address
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 padding-top-3">
                    <h1>Shipping Service</h1>
                    <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                    <br/>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($isIndonesian)
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <h1>JNE</h1>
                                    <br>
                                    <input type="radio" name="courier" id="jne" value="jne-REG" checked/> REG <br>
                                    <input type="radio" name="courier" id="jne" value="jne-OKE"/> OKE <br>
                                    <input type="radio" name="courier" id="jne" value="jne-YES"/> YES <br>
                                </div>
                                <div class="col-md-4">
                                    <h1>TIKI</h1>
                                    <br>
                                    <input type="radio" name="courier" id="jne" value="tiki-REG" /> REG (REGULER SERVICE) <br>
                                    <input type="radio" name="courier" id="jne" value="tiki-ONS" /> ONS (OVER NIGHT SERVICE) <br>
                                    <input type="radio" name="courier" id="jne" value="tiki-SDS" /> SDS (SAME DAY SERVICE) <br>
                                </div>
                                <div class="col-md-4">
                                    <h1>POS Indonesia</h1>
                                    <br>
                                    <input type="radio" name="courier" id="jne" value="pos-Paket Kilat Khusus" /> Paket Kilat Khusus <br>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <h1>Sicepat</h1>
                                    <br>
                                    <input type="radio" name="courier" id="jne" value="sicepat-REG"/> REG (Layanan Reguler) <br>
                                    <input type="radio" name="courier" id="jne" value="sicepat-OKE"/> BEST (Besok Sampai Tujuan) <br>
                                </div>
                                <div class="col-md-4">
                                    <h1>J&T</h1>
                                    {{--<img src="{{ asset('images/icons/nama-brand-pinterest.svg') }}" class="width-50">--}}
                                    <br>
                                    <input type="radio" name="courier" id="jne" value="J&T-EZ" /> EZ (Regular Service) <br>
                                    <input type="radio" name="courier" id="jne" value="J&T-JSD" /> JSD (Same Day Service) <br>
                                </div>
                            </div>
                            {{--jne, pos, tiki, rpx, esl, pcp, pandu, wahana, sicepat, jnt, pahala, cahaya, sap, jet, indah, dse, slis, first, ncs, star, ninja, lion, idl--}}
                            {{--<input type="radio" name="courier" id="jne" value="jne" />--}}
                            {{--<img src="{{ asset('images/icons/nama-brand-pinterest.svg') }}" class="width-50">--}}
                            {{--&nbsp;--}}
                            {{--<input type="radio" name="courier" id="tiki" value="tiki"/>--}}
                            {{--<img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-50">--}}

                            {{--<input type="radio" name="courier" id="pos" value="pos"/>--}}
                            {{--<img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-50">--}}

                            {{--<input type="radio" name="courier" id="sicepat" value="sicepat"/>--}}
                            {{--<img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-50">--}}

                            {{--<input type="radio" name="courier" id="jnt" value="jnt"/>--}}
                            {{--<img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-50">--}}

                            {{--<input type="radio" name="courier" id="jet" value="jet"/>--}}
                            {{--<img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-50">--}}

                            {{--<input type="radio" name="courier" id="ninja" value="ninja"/>--}}
                            {{--<img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-50">--}}
                        @endif
                    </div>
                </div>

                <div class="row padding-top-3">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        &nbsp;
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 text-center-xs">
                        <a href="{{ route('cart') }}"><button type="button" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 130px;line-height: 0px; border: 1px solid #282828;">BACK TO CART</button></a>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-3 text-center-xs" style="text-align: right;">
                        <button type="submit" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 120px;line-height: 0px; border: 1px solid #282828;">CONTINUE</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('styles')
    <style>
       .padding-top-3{
           padding-top: 3% !important;
       }
        .bg-white{
            padding-bottom:0;
        }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript">
        $("#another_shipment").change(function() {
            if(this.checked) {
                $('#new-address').show();
            }
            else{
                $('#new-address').hide();
            }
        });

        (function($){
            var province = $('#province');
            var city = $('#city');
            var cityOptions = city.children();

            province.on('change', function(){
                //remove the options
                cityOptions.detach();
                //readd only the options for the country
                cityOptions.filter(function(){
                    return this.value.indexOf(province.val() + "-") === 0;
                }).appendTo(city);
                //clear out the value so it doesn't default to one it should not
                city.val('');
            });
        }(jQuery));

        (function($){
            var province = $('#province_secondary');
            var city = $('#city_secondary');
            var cityOptions = city.children();

            province.on('change', function(){
                //remove the options
                cityOptions.detach();
                //readd only the options for the country
                cityOptions.filter(function(){
                    return this.value.indexOf(province.val() + "-") === 0;
                }).appendTo(city);
                //clear out the value so it doesn't default to one it should not
                city.val('');
            });
        }(jQuery));
    </script>
@endsection
