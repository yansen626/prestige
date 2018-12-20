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
                </div><!-- .col-md-8 end -->
                <div class="col-xs-12 col-sm-12 col-md-6" style="padding-top: 5%;">
                    <h2>{{$product->name}}</h2>
                    <H4>${{$product->price}} USD</H4>
                    <p style="text-transform: uppercase;">
                        {{$product->description}}
                    </p>

                    {!! Form::open(array('action' => 'Frontend\CartController@addCart', 'id'=>'form-search', 'class'=>'form-search', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}

                    <input type="hidden" name="slug" value="{{$product->slug}}">
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
                                <div id="collapse01-2" class="panel--body panel-collapse collapse">
                                    <span>Enter personalized text (max 8 characters)</span>
                                    <form>
                                        <input type="text" class="form-control" name="custom-text" id="custom-text" placeholder="TEXT HERE"/>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <p style="margin-bottom: 0;margin-left: 11%;">Choose Font</p>
                                            <select class="minimal" data-width="auto" name="custom-font">
                                                <option>SERIF</option>
                                                <option>SAN SERIF</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <p style="margin-bottom: 0;margin-left: 11%;">Choose Color</p>
                                            <select class="selectpicker minimal" data-width="auto" name="custom-color">
                                                <option>GOLD</option>
                                                <option>SILVER</option>
                                                <option>BRONZE</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <p style="margin-bottom: 0;margin-left: 11%;">Choose Size</p>
                                            <select class="selectpicker minimal" data-width="auto" name="custom-size">
                                                <option>LARGE</option>
                                                <option>MEDIUM</option>
                                                <option>SMALL</option>
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

                        <div style="padding: 5% 0 5% 0">
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
