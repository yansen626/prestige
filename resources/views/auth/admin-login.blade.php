@extends('layouts.admin-login')

@section('content')

    <h3>Nama E-Commerce</h3>
    <p>Admin Login</p>

    <form method="POST" action="{{ route('admin.login') }}">
        {{ csrf_field() }}
        @foreach($errors->all() as $error)
            <span class="help-block">
                <strong style="color: #ff3d00;"> {{ $error }} </strong>
            </span>
        @endforeach
        <div class="form-group has-icon"><i class="icon-envelope-o"></i>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}"
                   placeholder="Email Address">
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-icon"><i class="icon-user-secret"></i>
            <input type="password" id="password" name="password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}"
                   placeholder="Password">
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Log In">
    </form>

@endsection
