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
                    <div id="custom-section" style="display: none;">
                        <canvas id="myCanvas" width="600" height="600"></canvas>
                    </div>
                </div><!-- .col-md-8 end -->
                <div class="col-xs-12 col-sm-12 col-md-6" style="padding-top: 5%;">
                    <h2>{{$product->name}}</h2>
                    <H4>${{$product->price}} USD</H4>
                    <p style="text-transform: uppercase;">
                        {{$product->description}}
                    </p>

                    {!! Form::open(array('action' => 'Frontend\CartController@addCart', 'id'=>'form-search', 'class'=>'form-search', 'method' => 'POST', 'role' => 'form', 'onkeypress' => 'return event.keyCode != 13;', 'novalidate')) !!}

                    <input type="hidden" id="slug" name="slug" value="{{$product->slug}}">
                    <input type="hidden" id="position_x" value="{{$product->product_positions[0]->pos_x}}">
                    <input type="hidden" id="position_y" value="{{$product->product_positions[0]->pos_y}}">
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

                            <!-- Panel 01 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-2">
                                        Customization
                                    </a>
                                </div>
                                <div id="collapse01-2" class="panel--body panel-collapse collapse responsive-height">
                                    <span>Enter personalized text (max 8 characters)</span>
                                    <span>&nbsp;</span>
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

                    {!! Form::close() !!}
                </div><!-- .col-md-6 end-->
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #cover5 end -->
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
