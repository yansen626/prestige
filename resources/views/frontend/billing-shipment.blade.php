@extends('layouts.frontend')

@section('content')
    <section class="bg-white">
        <form method="POST" action="#">
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

                        @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="FIRST NAME" required/>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="LAST NAME" required/>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required/>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="PHONE NUMBER" required/>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        @endif

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
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="address_detail" id="address_detail" placeholder="HOUSE/APARTMENT/UNIT NUMBER" required/>
                            @if ($errors->has('address_detail'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address_detail') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="street" id="street" placeholder="STREET" required/>
                            @if ($errors->has('street'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('street') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="suburb" id="suburb" placeholder="SUBURB" required/>
                            @if ($errors->has('suburb'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('suburb') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="post_code" id="post_code" placeholder="POST CODE" required/>
                            @if ($errors->has('post_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('post_code') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="state" id="state" placeholder="STATE" required/>
                            @if ($errors->has('state'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-12 col-md-6">
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            <input type="radio" name="another_shipment" value="ship" class=""/> Ship to a different address
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-12 col-md-3">
                        <a href="{{ route('cart') }}"><button type="button" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 130px;line-height: 0px; border: 1px solid #282828;">BACK TO CART</button></a>
                    </div>
                    <div class="col-xs-6 col-sm-12 col-md-3" style="text-align: right;">
                        <button type="submit" class="btn btn--secondary btn--bordered" style="font-size: 11px; height: 31.5px; width: 120px;line-height: 0px; border: 1px solid #282828;">CONTINUE</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
