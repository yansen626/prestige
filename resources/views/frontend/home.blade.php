@extends('layouts.frontend')

@section('content')


    <!-- Slider #1
============================================= -->
    <section id="slider" class="carousel slider slider-shop slider-dots slider-navs" data-slide="1" data-slide-rs="1" data-autoplay="false" data-nav="false" data-dots="true" data-space="0" data-loop="true" data-speed="800">

        <!-- Slide #1 -->
        <div class="slide--item">
            {{--<div class="bg-section">--}}
                {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
            {{--</div>--}}
            <div class="pos-vertical-center">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="slide--headline center">
                        Bespoke & <br> Personalized <br> Leather Goods<br><br>
                        <a class="btn btn--secondary btn--bordered" href="#" style="width: 220px;">SHOP COLLECTION</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 slider-home" style="background-image: url('{{asset('images/Links/banner-1.jpg')}}')">
                    {{--<div class="bg-section">--}}
                    {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div><!-- .slide-item end -->

        <!-- Slide #2 -->
        <div class="slide--item">
            {{--<div class="bg-section">--}}
            {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
            {{--</div>--}}
            <div class="pos-vertical-center">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="slide--headline center">
                        Sustainable <br> Leather <br> Accessories<br>
                        <a class="btn btn--secondary btn--bordered" href="#" style="width: 220px;">SHOP COLLECTION</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 slider-home" style="background-image: url('{{asset('images/Links/banner-2.jpg')}}')">
                    {{--<div class="bg-section">--}}
                    {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div><!-- .slide-item end -->

        <!-- Slide #2 -->
        <div class="slide--item">
            {{--<div class="bg-section">--}}
            {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
            {{--</div>--}}
            <div class="pos-vertical-center">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="slide--headline center">
                        The Perfect Gift <br> or Everyday <br> Companion<br>
                        <a class="btn btn--secondary btn--bordered" href="#" style="width: 220px;">LET'S SHOP</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 slider-home" style="background-image: url('{{asset('images/Links/banner-3.jpg')}}')">
                    {{--<div class="bg-section">--}}
                    {{--<img src="{{ asset('images/sliders/slide-bg/banner-1.jpg') }}" alt="Background"/>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div><!-- .slide-item end -->

    </section>
    <a href="#testimonial1" class="down-button"><i class="fa fa-long-arrow-down"></i></a>

    <!-- Product #1
    ============================================= -->
    <section id="testimonial1" class="testimonial testimonial-boxed testimonial-1 bg-white pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 center">
                    <h2>Spring Favorites</h2>
                    <p>
                        REDEFINE SIMPLE EVERYDAY LUXURY WITH NAMA/S PRACTICAL,<BR>
                        TIMELESS AND HIGH DISTICTION PERSONALIZED LEATHER GOODS.<BR><BR>
                        ENJOY CHIC AND BESPOKE ACCESORIES WITH THE KNOWLEDGE THAT THEY<BR>
                        HAVE BEEN MADE WITH UTMOST CARE AND QUALITY.
                    </p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div id="testimonial-carousel" class="carousel carousel-dots" data-slide="3" data-slide-rs="1" data-autoplay="false" data-nav="true" data-dots="false" data-space="0" data-loop="true" data-speed="800" data-center="true">
                        <!-- Product -->
                        @foreach($products as $product)
                            @php($link = route('product.detail', ['product'=>$product->slug] ))
                            @php($productImage = $product->product_images->where('is_main_image', 1)->first())
                            <div class="testimonial-panel product-item">
                                <div class="product--img">
                                    <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="max-height: 300px; width: 100%;"/>
                                    <div class="product--hover">
                                        <div class="product--action">
                                            <a class="btn btn--secondary btn--bordered" href="{{$link}}">View</a>
                                        </div>
                                    </div><!-- .product-overlay end -->
                                </div><!-- .product-img end -->
                                <div class="product--content">
                                    <div class="product--title">
                                        <h3><a href="{{$link}}">{{$product->name}}</a></h3>
                                    </div><!-- .product-title end -->
                                    <div class="product--price">
                                        <span>Rp {{$product->price_string}}</span>
                                    </div><!-- .product-price end -->
                                </div><!-- .product-bio end -->
                            </div>
                        @endforeach
                    </div>
                </div><!-- .col-md-12 end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </section>
    <!-- #Product end -->


    <!-- Info #5
    ============================================= -->
    <section id="cover5" class="section cover-5 mtop-100 pt-0 pb-0">
        <div class="container-fluid">
            <div class="row comm-height">
                <div class="col-xs-12 col-sm-12 col-md-6 pr-0 pl-0">
                    <div class="bg-overlay">
                        <div class="bg-section">
                            <img src="{{asset('/images/Links/home-3.png')}}" alt="Background"/>
                        </div>
                    </div>
                </div><!-- .col-md-6 end-->
                <div class="col-xs-12 col-sm-12 col-md-6 col-content bg-pastel center">
                    <h3>Customize For A Tailored & Timeless Accessory</h3>
                    <a class="btn btn--secondary btn--bordered" href="#" style="width: 220px;">LET'S GO SHOPPING</a>
                </div>
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #Info end -->

    <!-- SnapWidget -->
    {{--<script src="https://snapwidget.com/js/snapwidget.js"></script>--}}
    {{--<iframe src="https://snapwidget.com/embed/653851" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>--}}
    {{--<div style="font:10px/14px 'Roboto','Helvetica Neue',Arial,Helvetica,sans-serif;font-weight:400;width:100%;text-align:right"><a href="https://snapwidget.com" style="color:#777;text-decoration:none;"></a></div>--}}
@endsection