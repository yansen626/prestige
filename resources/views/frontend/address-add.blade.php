@extends('layouts.frontend')

@section('content')
    <div class="col-md-12">
        <select name="country" id="country" class="form-control">
            <option value="-1">COUNTRY/REGION</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('country'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('country') }}</strong>
            </span>
        @endif
    </div>
@endsection