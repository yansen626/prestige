@extends('layouts.frontend')

@section('content')


    <!-- Info #1
============================================= -->
    <section id="cover5" class="section cover-5 mtop-100 pt-0 pb-0">
        <div class="container-fluid">
            <div class="row comm-height">
                <div class="col-xs-12 col-sm-12 col-md-6 col-content bg-pastel center">
                    <h3>Sustainable Practices</h3>
                    <p>
                        AT NAMA. WE BELIEVE IN THE BEAUTY OF SUSTAINABILITY AND ALWAYS AIM TO ARCHIVE THIS IN ALL WE DO.
                        <BR>
                        YOU CAN FIND OUT MORE ABOUT OUR PROCESSES BELOW.
                    </p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 pr-0 pl-0">
                    <div class="bg-overlay">
                        <div class="bg-section">
                            <img src="{{asset('/images/Links/home-3.png')}}" alt="Background"/>
                        </div>
                    </div>
                </div><!-- .col-md-6 end-->
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #Info end -->
    <a href="#testimonial1" class="down-button"><i class="fa fa-long-arrow-down"></i></a>

    <!-- Product #1
    ============================================= -->
    <section id="testimonial1" class="testimonial testimonial-boxed testimonial-1 bg-white pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 center">
                    <h2>Sustainable Practices</h2>
                    <h4>Eco Friendly</h4>
                    <p>
                        REDEFINE SIMPLE EVERYDAY LUXURY WITH NAMA/S PRACTICAL,<BR>
                        TIMELESS AND HIGH DISTICTION PERSONALIZED LEATHER GOODS.<BR><BR>
                        ENJOY CHIC AND BESPOKE ACCESORIES WITH THE KNOWLEDGE THAT THEY<BR>
                        HAVE BEEN MADE WITH UTMOST CARE AND QUALITY.
                    </p>
                    <h4>Top Quality</h4>
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
                                <div class="">
                                    <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="max-height: 300px; width: auto"/>
                                </div><!-- .product-img end -->
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
                <div class="col-xs-12 col-sm-12 col-md-6 col-content bg-windrift-blue center">
                    <h3>Customized Monogramming</h3>
                    <p>
                        AT NAMA. WE BELIEVE IN THE BEAUTY OF SUSTAINABILITY AND ALWAYS AIM TO ARCHIVE THIS IN ALL WE DO.
                        <BR>
                        YOU CAN FIND OUT MORE ABOUT OUR PROCESSES BELOW.
                    </p>
                </div>
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #Info end -->

    <!-- Product #1
    ============================================= -->
    <section id="testimonial1" class="testimonial testimonial-boxed testimonial-1 bg-white pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 center">
                    <h2>Personalization</h2>
                    <h4>Monogramming</h4>
                    <p>
                        REDEFINE SIMPLE EVERYDAY LUXURY WITH NAMA/S PRACTICAL,<BR>
                        TIMELESS AND HIGH DISTICTION PERSONALIZED LEATHER GOODS.<BR><BR>
                        ENJOY CHIC AND BESPOKE ACCESORIES WITH THE KNOWLEDGE THAT THEY<BR>
                        HAVE BEEN MADE WITH UTMOST CARE AND QUALITY.
                    </p>
                    <h4>Techniques & Materials</h4>
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
                                    <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="max-height: 300px; width: auto"/>
                                </div><!-- .product-img end -->
                            </div>
                        @endforeach
                    </div>
                </div><!-- .col-md-12 end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </section>
    <!-- #Product end -->
@endsection