@extends('layouts.frontend')

@section('content')
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h1>Register</h1>
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
                            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="EMAIL ADDRESS" required/>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}" placeholder="PHONE NUMBER" required/>
                        </div>

                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="PASSWORD" required/>
                        </div>

                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" placeholder="PASSWORD CONFIRMATION" required/>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="FIRST NAME" value="{{old('first_name')}}" required/>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="LAST NAME" value="{{old('last_name')}}" required/>
                        </div>

                        <div class="col-md-12 center">
                            <button type="submit" class="btn btn--secondary btn--bordered">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
