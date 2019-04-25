@extends('layouts.frontend')

@section('pageTitle', 'Reset Password | NAMA')
@section('content')
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h1>Reset Password</h1>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                            <br/>
                        </div>
                        <div class="col-md-12">
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>{{ \Illuminate\Support\Facades\Session::get('message') }}</strong>
                                </div>
                            @endif
                            @if($errors->count() > 0)
                                @foreach($errors->all() as $error)
                                    <span class="form-message">
                                        <strong> {{ $error }} </strong>
                                        <br/>
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="col-md-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL" required/>
                        </div>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="NEW PASSWORD" required/>
                        </div>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="CONFIRM PASSWORD" required/>
                        </div>
                        <div class="col-md-12 text--center pb-30">
                            <button type="submit" class="btn btn--secondary btn--bordered">Reset Password</button>
                        </div>
                    </div><!-- .col-md-12 end -->
                </form>
            </div><!-- .row end -->
        </div><!-- .container end -->
    </section>
@endsection

{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Reset Password') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('password.update') }}">--}}
                        {{--@csrf--}}

                        {{--<input type="hidden" name="token" value="{{ $token }}">--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Reset Password') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
