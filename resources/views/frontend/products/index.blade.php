@extends('layouts.frontend')

@section('content')

    @if($filter != -1)
    <!-- Cover #5
    ============================================= -->
    <section id="cover5" class="section cover-5 mtop-100 pt-0 pb-0">
        <div class="container-fluid">
            <div class="row comm-height">
                <div class="col-xs-12 col-sm-12 col-md-6 col-content center">
                    <a href="{{route('product.list')}}"><H4 class="header-menu">SHOP ALL</H4></a>
                    <a href="/product-list?category=1"><H4 class="header-menu">BAGS & TOTES</H4></a>
                    <a href="/product-list?category=2"><H4 class="header-menu">WALLETS</H4></a>
                    <a href="/product-list?category=3"><H4 class="header-menu">CARD HOLDERS</H4></a>
                    <a href="/product-list?category=4"><H4 class="header-menu">POUCHES</H4></a>
                    <a href="/product-list?category=5"><H4 class="header-menu">PHONE CASES</H4></a>
                </div><!-- .col-md-8 end -->
                <div class="col-xs-12 col-sm-12 col-md-6 pr-0 pl-0">
                    <div class="bg-overlay">
                        <div class="bg-section">
                            <img src="{{asset('/images/Links/product-list.jpg')}}" alt="Background"/>
                        </div>
                    </div>
                </div><!-- .col-md-6 end-->
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #cover5 end -->
    @endif

    <!-- Shop #4
    ============================================= -->
    <section id="shop" class="shop shop-4 bg-white" style="padding-bottom:50px;border-bottom: #0c0c0c;">
        <div class="container">
            <!-- Search Result -->
            @if($filter == -1)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 center">
                        <h3>Search Result of  "{{$searchText}}"</h3>
                    </div>
                    <!-- Product #1 -->
                    @foreach($productResult as $product)
                        @php($link = route('product.detail', ['product'=>$product->slug] ))
                        @php($productImage = $product->product_images->where('is_main_image', 1)->first())
                        <div class="col-xs-12 col-sm-6 col-md-3 product-item">
                            <div class="product--img">
                                <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="height: 300px; width: auto"/>
                                <div class="product--hover">
                                    <div class="product--action">
                                        <a class="btn btn--secondary btn--bordered" href="{{$link}}">View</a>
                                    </div>
                                </div><!-- .product-overlay end -->
                            </div><!-- .product-img end -->
                            <div class="product--content">
                                <div class="product--title" style="height: 50px;">
                                    <h3><a href="{{$link}}">{{ $product->name }}</a></h3>
                                </div><!-- .product-title end -->
                                <div class="product--price">
                                    <span>Rp {{ $product->price_string }}</span>
                                </div><!-- .product-price end -->
                            </div><!-- .product-bio end -->
                        </div>
                @endforeach
                <!-- .product end -->
                </div><!-- .row end -->
            @endif

            @if($filter == 0 || $filter == 1)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 center">
                        <h3>Bags & Totes</h3>
                    </div>
                    <!-- Product #1 -->
                    @php($products = $productResult->where('category_id', 1))
                    @foreach($products as $product)
                        @php($link = route('product.detail', ['product'=>$product->slug] ))
                        @php($productImage = $product->product_images->where('is_main_image', 1)->first())
                        <div class="col-xs-12 col-sm-6 col-md-3 product-item">
                            <div class="product--img">
                                <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="height: 300px; width: auto"/>
                                <div class="product--hover">
                                    <div class="product--action">
                                        <a class="btn btn--secondary btn--bordered" href="{{$link}}">View</a>
                                    </div>
                                </div><!-- .product-overlay end -->
                            </div><!-- .product-img end -->
                            <div class="product--content">
                                <div class="product--title" style="height: 50px;">
                                    <h3><a href="{{$link}}">{{$product->name}}</a></h3>
                                </div><!-- .product-title end -->
                                <div class="product--price">
                                    <span>Rp {{$product->price_string}}</span>
                                </div><!-- .product-price end -->
                            </div><!-- .product-bio end -->
                        </div>
                @endforeach
                <!-- .product end -->
                </div><!-- .row end -->
            @endif
            @if($filter == 0 || $filter == 2)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 center">
                        <h3>Wallets</h3>
                    </div>
                    <!-- Product #1 -->
                    @php($products = $productResult->where('category_id', 2))
                    @foreach($products as $product)
                        @php($link = route('product.detail', ['product'=>$product->slug] ))
                        @php($productImage = $product->product_images->where('is_main_image', 1)->first())
                        <div class="col-xs-12 col-sm-6 col-md-3 product-item">
                            <div class="product--img">
                                <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="height: 300px; width: auto"/>
                                <div class="product--hover">
                                    <div class="product--action">
                                        <a class="btn btn--secondary btn--bordered" href="{{$link}}">View</a>
                                    </div>
                                </div><!-- .product-overlay end -->
                            </div><!-- .product-img end -->
                            <div class="product--content">
                                <div class="product--title" style="height: 50px;">
                                    <h3><a href="{{$link}}">{{$product->name}}</a></h3>
                                </div><!-- .product-title end -->
                                <div class="product--price">
                                    <span>Rp {{$product->price_string}}</span>
                                </div><!-- .product-price end -->
                            </div><!-- .product-bio end -->
                        </div>
                @endforeach
                <!-- .product end -->
                </div><!-- .row end -->
            @endif
            @if($filter == 0 || $filter == 3)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 center">
                        <h3>Card Holders</h3>
                    </div>
                    <!-- Product #1 -->
                    @php($products = $productResult->where('category_id', 3))
                    @foreach($products as $product)
                        @php($link = route('product.detail', ['product'=>$product->slug] ))
                        @php($productImage = $product->product_images->where('is_main_image', 1)->first())
                        <div class="col-xs-12 col-sm-6 col-md-3 product-item">
                            <div class="product--img">
                                <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="height: 300px; width: auto"/>
                                <div class="product--hover">
                                    <div class="product--action">
                                        <a class="btn btn--secondary btn--bordered" href="{{$link}}">View</a>
                                    </div>
                                </div><!-- .product-overlay end -->
                            </div><!-- .product-img end -->
                            <div class="product--content">
                                <div class="product--title" style="height: 50px;">
                                    <h3><a href="{{$link}}">{{$product->name}}</a></h3>
                                </div><!-- .product-title end -->
                                <div class="product--price">
                                    <span>Rp {{$product->price_string}}</span>
                                </div><!-- .product-price end -->
                            </div><!-- .product-bio end -->
                        </div>
                @endforeach
                <!-- .product end -->
                </div><!-- .row end -->
            @endif
            @if($filter == 0 || $filter == 4)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 center">
                        <h3>Pouches</h3>
                    </div>
                    <!-- Product #1 -->
                    @php($products = $productResult->where('category_id', 4))
                    @foreach($products as $product)
                        @php($link = route('product.detail', ['product'=>$product->slug] ))
                        @php($productImage = $product->product_images->where('is_main_image', 1)->first())
                        <div class="col-xs-12 col-sm-6 col-md-3 product-item">
                            <div class="product--img">
                                <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="height: 300px; width: auto"/>
                                <div class="product--hover">
                                    <div class="product--action">
                                        <a class="btn btn--secondary btn--bordered" href="{{$link}}">View</a>
                                    </div>
                                </div><!-- .product-overlay end -->
                            </div><!-- .product-img end -->
                            <div class="product--content">
                                <div class="product--title" style="height: 50px;">
                                    <h3><a href="{{$link}}">{{$product->name}}</a></h3>
                                </div><!-- .product-title end -->
                                <div class="product--price">
                                    <span>Rp {{$product->price_string}}</span>
                                </div><!-- .product-price end -->
                            </div><!-- .product-bio end -->
                        </div>
                @endforeach
                <!-- .product end -->
                </div><!-- .row end -->
            @endif
            @if($filter == 0 || $filter == 5)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 center">
                        <h3>Phone Cases</h3>
                    </div>
                    <!-- Product #1 -->
                    @php($products = $productResult->where('category_id', 5))
                    @foreach($products as $product)
                        @php($link = route('product.detail', ['product'=>$product->slug] ))
                        @php($productImage = $product->product_images->where('is_main_image', 1)->first())
                        <div class="col-xs-12 col-sm-6 col-md-3 product-item">
                            <div class="product--img">
                                <img src="{{ asset('storage/products/'.$productImage->path) }}" alt="Product" style="height: 300px; width: auto"/>
                                <div class="product--hover">
                                    <div class="product--action">
                                        <a class="btn btn--secondary btn--bordered" href="{{$link}}">View</a>
                                    </div>
                                </div><!-- .product-overlay end -->
                            </div><!-- .product-img end -->
                            <div class="product--content">
                                <div class="product--title" style="height: 50px;">
                                    <h3><a href="{{$link}}">{{$product->name}}</a></h3>
                                </div><!-- .product-title end -->
                                <div class="product--price">
                                    <span>Rp {{$product->price_string}}</span>
                                </div><!-- .product-price end -->
                            </div><!-- .product-bio end -->
                        </div>
                @endforeach
                <!-- .product end -->
                </div><!-- .row end -->
            @endif
        </div><!-- .container end -->
    </section><!-- #shop end -->@endsection
