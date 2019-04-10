<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <!-- Document Meta
        ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- gsuite meta tag --}}
    <!--IE Compatibility Meta-->
    <meta name="author" content="zytheme"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Multi-purpose Business html5 template">

    <!-- Fonts
        ============================================= -->
    {{--<link href="http://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CPlayfair+Display:400,400i,700,700i,900,900i%7CDroid+Serif" rel="stylesheet" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Work+Sans:400,500" rel="stylesheet" type="text/css">

    <!-- Stylesheets
        ============================================= -->
    <link href="{{ asset('css/frontend/external.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/bootstrap.min.css') }}" rel="stylesheet">
    <style type="text/css" media="print">
        @page
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
    </style>
</head>
<body>
{{--<div class="preloader">--}}
{{--<div class="spinner">--}}
{{--<div class="bounce1"></div>--}}
{{--<div class="bounce2"></div>--}}
{{--<div class="bounce3"></div>--}}
{{--</div>--}}
{{--</div><!-- Document Wrapper--}}
{{--============================================= -->--}}
<div id="wrapper" class="wrapper clearfix">
    <div class="col-md-6">
        <h4>From : Nama-Official</h4>
        <p>
            {{$namaAddress->description}}, {{$namaAddress->city->name}}<br>
            {{$namaAddress->province->name}}, {{$namaAddress->postal_code}}<br>
            Phone : 0813 7007 0017
        </p>
        <h4>To : {{$custDB->first_name}} {{$custDB->last_name}}</h4>
        <p>
            {{$custAddress->description}}, {{$custAddress->city->name}}<br>
            {{$custAddress->province->name}}, {{$custAddress->postal_code}}<br>
            Phone : {{$custDB->phone}}
        </p>
    </div>
</div><!-- #wrapper end -->

<!-- Footer Scripts
    ============================================= -->
<script src="{{ asset('js/frontend/jquery-2.2.4.min.js')}}"></script>
<script>
    window.onload = function() { window.print(); }
</script>
</body>
</html>