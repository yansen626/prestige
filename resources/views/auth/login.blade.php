@extends('layouts.frontend')

@section('content')
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h1>Login</h1>
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
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
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
                                <span>Remember Me</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn--primary btn--block">Login</button>
                        </div>
                    </div><!-- .col-md-12 end -->
                </form>
            </div><!-- .row end -->
        </div><!-- .container end -->
    </section>
@endsection
