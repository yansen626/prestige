@extends('layouts.frontend')

@section('content')

    <!-- Cover #5
    ============================================= -->
    <section id="cover5" class="section mtop-100 pt-0 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-content bg-windrift-blue center" >
                    <section id="slider-product" class="carousel slider slider-shop slider-dots" data-slide="1" data-slide-rs="1" data-autoplay="false" data-nav="true" data-dots="true" data-space="0" data-loop="true" data-speed="800">
                        @php($productImages = $product->product_images)
                        @php($productMainImages = $product->product_images->where('is_main_image', 1)->first())
                        @foreach($productImages as $images)
                            <!-- Slide -->
                                <div class="slide--item">
                                    {{--<div class="bg-section">--}}
                                    {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
                                    {{--</div>--}}
                                    <div class="pos-vertical-center">
                                        <div class="col-xs-12 col-sm-12 col-md-12 slider-home" style="background-image: url('{{ asset('storage/products/'.$images->path) }}')">
                                            {{--<div class="bg-section">--}}
                                            {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div><!-- .slide-item end -->
                        @endforeach
                    </section>
                    <div id="custom-section" style="display: none; margin-left:-50px !important;">
                        <canvas id="myCanvas" width="600" height="600"></canvas>
                    </div>
                </div><!-- .col-md-8 end -->
                <div class="col-xs-12 col-sm-12 col-md-6" style="padding-top: 5%;">
                    <h2>{{$product->name}}</h2>
                    <H4>Rp {{$product->price}}</H4>
                    <p style="text-transform: uppercase;">
                        {{$product->description}}
                    </p>

                    {!! Form::open(array('action' => 'Frontend\CartController@addCart', 'id'=>'form-search', 'class'=>'form-search', 'method' => 'POST', 'role' => 'form', 'onkeypress' => 'return event.keyCode != 13;', 'novalidate')) !!}

                    <input type="hidden" id="slug" name="slug" value="{{$product->slug}}">
                    <input type="hidden" id="position_x" value="{{$product->product_positions[0]->pos_x}}">
                    <input type="hidden" id="position_y" value="{{$product->product_positions[0]->pos_y}}">

                    <br><br>
                    <div class="col-xs-6 col-sm-6 col-md-6 text--left">
                        <H4>Customization</H4>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 text--right">
                        <button type="button" class="btn btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div>
                    <div id="customize-section" class="customize-section">
                        <div class="col-md-12">
                            <p>Enter personalized text (max 8 characters)</p>
                            <form>
                                <input type="text" class="form-control auto-blur"
                                       name="custom-text" id="custom-text" placeholder="TEXT HERE" maxlength="8"
                                       onfocusout="ChangePosition()" style="text-transform:uppercase" />
                                <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                                    <p style="margin-bottom: 0;margin-left: 11%;">Position</p>
                                    <select class="minimal" data-width="auto"
                                            id="custom-position" name="custom-position"
                                            onchange="ChangeSelectedPosition()" style="width: 130px;">
                                        @foreach($product->product_positions as $position)
                                            @php($value=$position->pos_x."-".$position->pos_y)
                                            <option value="{{$value}}">{{$position->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                                    <p style="margin-bottom: 0;margin-left: 11%;">Font</p>
                                    <select class="minimal" data-width="auto" id="custom-font" name="custom-font" onchange="ChangePosition()">
                                        <option value="Serif">SERIF</option>
                                        <option value="Sans-serif">SAN SERIF</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                                    <p style="margin-bottom: 0;margin-left: 11%;">Color</p>
                                    <select class="selectpicker minimal" data-width="auto" id="custom-color" name="custom-color" onchange="ChangePosition()">
                                        <option value="Gold-FFD700">GOLD</option>
                                        <option value="Silver-C0C0C0">SILVER</option>
                                        <option value="Bronze-CD7F32">BRONZE</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                                    <p style="margin-bottom: 0;margin-left: 11%;">Size</p>
                                    <select class="selectpicker minimal" data-width="auto" id="custom-size" name="custom-size" onchange="ChangePosition()">
                                        <option value="Large-24">LARGE</option>
                                        <option value="Medium-20">MEDIUM</option>
                                        <option value="Small-16">SMALL</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div>
                        <!-- Accordion #1
                        ============================================= -->
                        <div id="accordion1">
                            <div class="accordion accordion-1" id="accordion01">
                                <!-- Panel 01 -->
                                <div class="panel">
                                    <div class="panel--heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-1">
                                            Specifications
                                        </a>
                                    </div>
                                    <div id="collapse01-1" class="panel--body panel-collapse collapse in">
                                        Product Specifications Product Specifications Product Specifications Product Specifications Product Specifications Product Specifications Product Specifications
                                    </div>
                                </div>

                                {{--<!-- Panel 01 -->--}}
                                {{--<div class="panel">--}}
                                    {{--<div class="panel--heading">--}}
                                        {{--<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-2">--}}
                                            {{--Customization--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div id="collapse01-2" class="panel--body panel-collapse collapse responsive-height">--}}
                                        {{--<span>Enter personalized text (max 8 characters)</span>--}}
                                        {{--<span>&nbsp;</span>--}}
                                        {{--<form>--}}
                                            {{--<input type="text" class="form-control auto-blur"--}}
                                                   {{--name="custom-text" id="custom-text" placeholder="TEXT HERE" maxlength="8"--}}
                                                   {{--onfocusout="ChangePosition()" style="text-transform:uppercase" />--}}
                                            {{--<div class="col-xs-12 col-sm-12 col-md-3 text-center">--}}
                                                {{--<p style="margin-bottom: 0;margin-left: 11%;">Position</p>--}}
                                                {{--<select class="minimal" data-width="auto"--}}
                                                        {{--id="custom-position" name="custom-position"--}}
                                                        {{--onchange="ChangeSelectedPosition()" style="width: 130px;">--}}
                                                    {{--@foreach($product->product_positions as $position)--}}
                                                        {{--@php($value=$position->pos_x."-".$position->pos_y)--}}
                                                        {{--<option value="{{$value}}">{{$position->name}}</option>--}}
                                                    {{--@endforeach--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-12 col-sm-12 col-md-3 text-center">--}}
                                                {{--<p style="margin-bottom: 0;margin-left: 11%;">Font</p>--}}
                                                {{--<select class="minimal" data-width="auto" id="custom-font" name="custom-font" onchange="ChangePosition()">--}}
                                                    {{--<option value="Serif">SERIF</option>--}}
                                                    {{--<option value="Sans-serif">SAN SERIF</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-12 col-sm-12 col-md-3 text-center">--}}
                                                {{--<p style="margin-bottom: 0;margin-left: 11%;">Color</p>--}}
                                                {{--<select class="selectpicker minimal" data-width="auto" id="custom-color" name="custom-color" onchange="ChangePosition()">--}}
                                                    {{--<option value="Gold-FFD700">GOLD</option>--}}
                                                    {{--<option value="Silver-C0C0C0">SILVER</option>--}}
                                                    {{--<option value="Bronze-CD7F32">BRONZE</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-12 col-sm-12 col-md-3 text-center">--}}
                                                {{--<p style="margin-bottom: 0;margin-left: 11%;">Size</p>--}}
                                                {{--<select class="selectpicker minimal" data-width="auto" id="custom-size" name="custom-size" onchange="ChangePosition()">--}}
                                                    {{--<option value="Large-24">LARGE</option>--}}
                                                    {{--<option value="Medium-20">MEDIUM</option>--}}
                                                    {{--<option value="Small-16">SMALL</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <!-- Panel 03 -->
                                <div class="panel">
                                    <div class="panel--heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-3">
                                            Delivery & Returns
                                        </a>
                                    </div>
                                    <div id="collapse01-3" class="panel--body panel-collapse collapse">
                                        Delivery and Returns Delivery and Returns Delivery and Returns Delivery and Returns Delivery and Returns Delivery and Returns Delivery and Returns
                                    </div>
                                </div>
                            </div>
                            <!-- End .Accordion-->

                            <div class="mobile-center" style="padding: 5% 0 5% 0">
                                <button class="btn btn--secondary btn--bordered" type="submit">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div><!-- .col-md-6 end-->
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #cover5 end -->
@endsection

@section('styles')
    <style>
        .customize-section{
            padding-bottom: 35%;
        }
        body {
            font-family: "Montserrat", "Lato", "Open Sans", "Helvetica Neue", Helvetica, Calibri, Arial, sans-serif;
            color: #6b7381;
            background: #f2f2f2;
        }
        .jumbotron {
            background: #6b7381;
            color: #bdc1c8;
        }
        .jumbotron h1 {
            color: #fff;
        }
        .example {
            margin: 4rem auto;
        }
        .example > .row {
            margin-top: 2rem;
            height: 5rem;
            vertical-align: middle;
            text-align: center;
            border: 1px solid rgba(189, 193, 200, 0.5);
        }
        .example > .row:first-of-type {
            border: none;
            height: auto;
            text-align: left;
        }
        .example h3 {
            font-weight: 400;
        }
        .example h3 > small {
            font-weight: 200;
            font-size: 0.75em;
            color: #939aa5;
        }
        .example h6 {
            font-weight: 700;
            font-size: 0.65rem;
            letter-spacing: 3.32px;
            text-transform: uppercase;
            color: #bdc1c8;
            margin: 0;
            line-height: 5rem;
        }
        .example .btn-toggle {
            top: 50%;
            transform: translateY(-50%);
        }
        .btn-toggle {
            margin: 0 4rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 3rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #bdc1c8;
        }
        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }
        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }
        .btn-toggle:before {
            content: "Off";
            left: -4rem;
        }
        .btn-toggle:after {
            content: "On";
            right: -4rem;
            opacity: 0.5;
        }
        .btn-toggle > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }
        .btn-toggle.active {
            transition: background-color 0.25s;
        }
        .btn-toggle.active > .handle {
            left: 1.6875rem;
            transition: left 0.25s;
        }
        .btn-toggle.active:before {
            opacity: 0.5;
        }
        .btn-toggle.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }
        .btn-toggle.btn-sm:before {
            text-align: right;
        }
        .btn-toggle.btn-sm:after {
            text-align: left;
            opacity: 0;
        }
        .btn-toggle.btn-sm.active:before {
            opacity: 0;
        }
        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            display: none;
        }
        .btn-toggle:before,
        .btn-toggle:after {
            color: #6b7381;
        }
        .btn-toggle.active {
            background-color: #29b5a8;
        }
        .btn-toggle.btn-lg {
            margin: 0 5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 2.5rem;
            width: 5rem;
            border-radius: 2.5rem;
        }
        .btn-toggle.btn-lg:focus,
        .btn-toggle.btn-lg.focus,
        .btn-toggle.btn-lg:focus.active,
        .btn-toggle.btn-lg.focus.active {
            outline: none;
        }
        .btn-toggle.btn-lg:before,
        .btn-toggle.btn-lg:after {
            line-height: 2.5rem;
            width: 5rem;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }
        .btn-toggle.btn-lg:before {
            content: "Off";
            left: -5rem;
        }
        .btn-toggle.btn-lg:after {
            content: "On";
            right: -5rem;
            opacity: 0.5;
        }
        .btn-toggle.btn-lg > .handle {
            position: absolute;
            top: 0.3125rem;
            left: 0.3125rem;
            width: 1.875rem;
            height: 1.875rem;
            border-radius: 1.875rem;
            background: #fff;
            transition: left 0.25s;
        }
        .btn-toggle.btn-lg.active {
            transition: background-color 0.25s;
        }
        .btn-toggle.btn-lg.active > .handle {
            left: 2.8125rem;
            transition: left 0.25s;
        }
        .btn-toggle.btn-lg.active:before {
            opacity: 0.5;
        }
        .btn-toggle.btn-lg.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-lg.btn-sm:before,
        .btn-toggle.btn-lg.btn-sm:after {
            line-height: 0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.6875rem;
            width: 3.875rem;
        }
        .btn-toggle.btn-lg.btn-sm:before {
            text-align: right;
        }
        .btn-toggle.btn-lg.btn-sm:after {
            text-align: left;
            opacity: 0;
        }
        .btn-toggle.btn-lg.btn-sm.active:before {
            opacity: 0;
        }
        .btn-toggle.btn-lg.btn-sm.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-lg.btn-xs:before,
        .btn-toggle.btn-lg.btn-xs:after {
            display: none;
        }
        .btn-toggle.btn-sm {
            margin: 0 0.5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 3rem;
            border-radius: 1.5rem;
        }
        .btn-toggle.btn-sm:focus,
        .btn-toggle.btn-sm.focus,
        .btn-toggle.btn-sm:focus.active,
        .btn-toggle.btn-sm.focus.active {
            outline: none;
        }
        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: 1.5rem;
            width: 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.55rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }
        .btn-toggle.btn-sm:before {
            content: "Off";
            left: -0.5rem;
        }
        .btn-toggle.btn-sm:after {
            content: "On";
            right: -0.5rem;
            opacity: 0.5;
        }
        .btn-toggle.btn-sm > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }
        .btn-toggle.btn-sm.active {
            transition: background-color 0.25s;
        }
        .btn-toggle.btn-sm.active > .handle {
            left: 1.6875rem;
            transition: left 0.25s;
        }
        .btn-toggle.btn-sm.active:before {
            opacity: 0.5;
        }
        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-sm.btn-sm:before,
        .btn-toggle.btn-sm.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }
        .btn-toggle.btn-sm.btn-sm:before {
            text-align: right;
        }
        .btn-toggle.btn-sm.btn-sm:after {
            text-align: left;
            opacity: 0;
        }
        .btn-toggle.btn-sm.btn-sm.active:before {
            opacity: 0;
        }
        .btn-toggle.btn-sm.btn-sm.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-sm.btn-xs:before,
        .btn-toggle.btn-sm.btn-xs:after {
            display: none;
        }
        .btn-toggle.btn-xs {
            margin: 0 0;
            padding: 0;
            position: relative;
            border: none;
            height: 1rem;
            width: 2rem;
            border-radius: 1rem;
        }
        .btn-toggle.btn-xs:focus,
        .btn-toggle.btn-xs.focus,
        .btn-toggle.btn-xs:focus.active,
        .btn-toggle.btn-xs.focus.active {
            outline: none;
        }
        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            line-height: 1rem;
            width: 0;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }
        .btn-toggle.btn-xs:before {
            content: "Off";
            left: 0;
        }
        .btn-toggle.btn-xs:after {
            content: "On";
            right: 0;
            opacity: 0.5;
        }
        .btn-toggle.btn-xs > .handle {
            position: absolute;
            top: 0.125rem;
            left: 0.125rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 0.75rem;
            background: #fff;
            transition: left 0.25s;
        }
        .btn-toggle.btn-xs.active {
            transition: background-color 0.25s;
        }
        .btn-toggle.btn-xs.active > .handle {
            left: 1.125rem;
            transition: left 0.25s;
        }
        .btn-toggle.btn-xs.active:before {
            opacity: 0.5;
        }
        .btn-toggle.btn-xs.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-xs.btn-sm:before,
        .btn-toggle.btn-xs.btn-sm:after {
            line-height: -1rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.275rem;
            width: 1.55rem;
        }
        .btn-toggle.btn-xs.btn-sm:before {
            text-align: right;
        }
        .btn-toggle.btn-xs.btn-sm:after {
            text-align: left;
            opacity: 0;
        }
        .btn-toggle.btn-xs.btn-sm.active:before {
            opacity: 0;
        }
        .btn-toggle.btn-xs.btn-sm.active:after {
            opacity: 1;
        }
        .btn-toggle.btn-xs.btn-xs:before,
        .btn-toggle.btn-xs.btn-xs:after {
            display: none;
        }
        .btn-toggle.btn-secondary {
            color: #6b7381;
            background: #bdc1c8;
        }
        .btn-toggle.btn-secondary:before,
        .btn-toggle.btn-secondary:after {
            color: #6b7381;
        }
        .btn-toggle.btn-secondary.active {
            background-color: #ff8300;
        }

    </style>
@endsection

@section('scripts')
    <script>
        function ChangeSelectedPosition(){
            var selectedPosition = $('#custom-position').val();
            var positionArr = selectedPosition.split("-");
            $('#position_x').val(positionArr[0]);
            $('#position_y').val(positionArr[1]);
            ChangePosition();
        }
        function ChangePosition(){
            $('#slider-product').hide();
            $('#custom-section').show();

            var text = $('#custom-text').val().toUpperCase();
            var selectedPosition = $('#custom-position').val();
            var selectedFont = $('#custom-font').val();
            var color = $('#custom-color').val();
            var size = $('#custom-size').val();
            var posX = $('#position_x').val();
            var posY = $('#position_y').val();

            var colorArr = color.split("-");
            var sizeArr = size.split("-");

            var font = sizeArr[1] + "px " + selectedFont;
            var fillStyle = "#"+colorArr[1];

            var canvas = document.getElementById("myCanvas");
            var context = canvas.getContext("2d");
            var imageObj = new Image();
            imageObj.onload = function(){
                context.drawImage(imageObj, 10, 10);
                context.textAlign = 'center';
                context.font = font;
                context.fillStyle = fillStyle;
                context.fillText(text, posX, posY);
            };

            imageObj.src = "{{ asset('storage/products/'.$productMainImages->path) }}";
        }


        // Auto onfocusout when enter is pressed
        $('.auto-blur').keypress(function (e) {
            if (e.which == 13) {
                $(this).blur();
            }
        });
    </script>

@endsection
