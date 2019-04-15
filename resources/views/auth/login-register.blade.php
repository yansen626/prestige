@extends('layouts.frontend')

@section('content')
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center p-b-40">
                    @foreach($errors->all() as $error)
                        <span class="form-message">
                            <strong> {{ $error }} </strong>
                            <br/>
                        </span>
                    @endforeach
                </div>
                <div class="col-md-6 col-sm-12">
                    <form method="POST" action="{{ route('signin') }}">
                        @csrf
                        <div class="col-md-12">
                            <h2 style="font-size: 24px;">Login</h2>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                            <br/>
                        </div>
                        {{--<div class="col-md-12">--}}
                            {{--@if($errors->count() > 0)--}}
                                {{--@foreach($errors->all() as $error)--}}
                                    {{--<span class="form-message">--}}
                                    {{--<strong> {{ $error }} </strong>--}}
                                    {{--<br/>--}}
                                {{--</span>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL" required/>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="PASSWORD" required/>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="input-checkbox">
                                <label class="label-checkbox">
                                    <input type="checkbox" name="remember" id="remember"/>
                                    <div class="check-indicator"></div>
                                </label>
                                <span>REMEMBER ME</span>
                            </div>
                        </div>
                        <div class="col-md-12 text--center">
                            <button type="submit" class="btn btn--primary btn--bordered">Login</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-md-12">
                            <h2 style="font-size: 24px;">Register</h2>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                            <br/>
                        </div>
                        {{--<div class="col-md-12">--}}
                            {{--@foreach($errors->all() as $error)--}}
                                {{--<span class="form-message">--}}
                                    {{--<strong> {{ $error }} </strong>--}}
                                    {{--<br/>--}}
                                {{--</span>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="FIRST NAME" required/>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="LAST NAME" required/>
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required/>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="PHONE NUMBER" required/>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="PASSWORD" required/>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="PASSWORD CONFIRMATION" required/>
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-12 text--center">
                            <button type="submit" class="btn btn--primary btn--bordered">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
