
<header id="navbar-spy" class="header header-13 header-topbar header-light header-fixed">
    <div id="top-bar" class="top-bar">
        <div class="container">
            <div class="bottom-bar-border">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 top--contact center color-black">
                        <ul class="list-inline mb-0">
                            <li>
                                <span>FREE SHIPPING ON All ORDERS OVER XXX</span>
                            </li>
                        </ul>
                    </div><!-- .col-md-6 end -->
                </div>
            </div>
        </div>
    </div>

    <!-- Menu section DESKTOP
    ============================================= -->
    <nav id="primary-menu" class="navbar navbar-fixed-top hidden-sm hidden-xs">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse-2">
                <!-- Module Shop -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a class="pointer">SHOP</a>
                    </div>
                    <div class="module-content module-fullscreen module--search2-box">
                        <div class="pos-vertical-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 center">
                                        <a href="{{route('product.list')}}"><H4 class="header-menu">SHOP ALL</H4></a>
                                        <a href="/product-list?category=1"><H4 class="header-menu">BAGS & TOTES</H4></a>
                                        <a href="/product-list?category=2"><H4 class="header-menu">WALLETS</H4></a>
                                        <a href="/product-list?category=3"><H4 class="header-menu">CARD HOLDERS</H4></a>
                                        <a href="/product-list?category=4"><H4 class="header-menu">POUCHES</H4></a>
                                        <a href="/product-list?category=5"><H4 class="header-menu">PHONE CASES</H4></a>
                                    </div><!-- .col-md-8 end -->
                                </div><!-- .row end -->
                            </div><!-- .container end -->
                        </div>
                        <a class="module-cancel pointer"><i class="fa fa-close"></i></a>
                    </div>
                </div><!-- .module-Shop end -->

                <!-- Module About -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a href="{{route('about.us')}}">ABOUT</a>
                    </div>
                    {{--<div class="module-content module-fullscreen module--search2-box">--}}
                    {{--<div class="pos-vertical-center">--}}
                    {{--<div class="container">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                    {{--<form class="form-search2">--}}
                    {{--<input type="text" class="form-control" placeholder="test">--}}
                    {{--<button class="btn" type="button"><i class="fa fa-search"></i></button>--}}
                    {{--</form><!-- .form-search end -->--}}
                    {{--</div><!-- .col-md-8 end -->--}}
                    {{--</div><!-- .row end -->--}}
                    {{--</div><!-- .container end -->--}}
                    {{--</div>--}}
                    {{--<a class="module-cancel" href="#"><i class="fa fa-close"></i></a>--}}
                    {{--</div>--}}
                </div><!-- .module-About end -->
                <!-- Module About -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        <a href="{{route('contact-form')}}">CONTACT</a>
                    </div>
                </div><!-- .module-About end -->

                {{--<!-- Module Contact -->--}}
                {{--<div class="module module-search2 pull-left">--}}
                    {{--<div class="module-icon search-icon color-black">--}}
                        {{--<a class="pointer">CONTACT OLD</a>--}}
                    {{--</div>--}}
                    {{--<div class="module-content module-fullscreen module--search2-box">--}}
                        {{--<div class="pos-vertical-center">--}}
                            {{--<div class="container">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-xs-6 col-sm-6 col-md-6" style="padding: 0 1% 0 7%;">--}}
                                        {{--<h2>Contact</h2>--}}
                                        {{--<hr style="height:1px;border:none;color:#333;background-color:#333;" />--}}
                                        {{--<br/>--}}
                                        {{--{!! Form::open(array('action' => 'Frontend\HomeController@contact', 'id'=>'form-contact', 'class'=>'form-search2', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}--}}

                                            {{--<input type="text" class="form-control" name="name" id="name" placeholder="NAME" required/>--}}
                                            {{--<input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required/>--}}
                                            {{--<input type="text" class="form-control" name="order" id="order" placeholder="ORDER NUMBER (IF APPLICABLE)"/>--}}
                                            {{--<textarea class="form-control" name="message" id="message" rows="2" placeholder="MESSAGE" required></textarea>--}}

                                            {{--<div style="text-align: center;">--}}
                                                {{--<button type="submit" class="btn btn--secondary btn--bordered">SEND</button>--}}
                                            {{--</div>--}}

                                        {{--{!! Form::close() !!}--}}
                                    {{--</div><!-- .col-md-8 end -->--}}
                                {{--</div><!-- .row end -->--}}
                            {{--</div><!-- .container end -->--}}
                        {{--</div>--}}
                        {{--<a class="module-cancel pointer"><i class="fa fa-close"></i></a>--}}
                    {{--</div>--}}
                {{--</div><!-- .module-Contact end -->--}}

                <!-- Module Search -->
                <div class="module module-search pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a class="pointer">SEARCH</a>
                    </div>
                    <div class="module-content module-fullscreen module--search-box">
                        <div class="pos-vertical-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 center">
                                        <h4>Search</h4>

                                        {!! Form::open(array('action' => 'Frontend\ProductController@search', 'id'=>'form-search', 'class'=>'form-search', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}

                                        <input type="text" class="form-control" id="search-text" name="search-text">
                                        <button class="btn search-button contact-button" type="button" onClick="empty()" >
                                            <i class="fa fa-long-arrow-right"></i>
                                        </button>

                                        {!! Form::close() !!}
                                    </div><!-- .col-md-8 end -->
                                </div><!-- .row end -->
                            </div><!-- .container end -->
                        </div>
                        <a class="module-cancel pointer"><i class="fa fa-close"></i></a>
                    </div>
                </div><!-- .module-search end -->

            </div>
            <!-- .navbar-collapse -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="{{route('home')}}" style="padding-top: 1%;">
                    {{--<img class="logo-light" src="{{ asset('images/icons/nama-brand-logo.svg') }}" alt="Nama Logo">--}}
                    {{--<img class="logo-dark" src="{{ asset('images/icons/nama-brand-logo.svg') }}" alt="Nama Logo">--}}
                    {{--<img  src="{{ asset('images/icons/nama-brand-logo-black.png') }}" alt="Nama Logo">--}}
                    <h1 style="font-size: 48px;">nama.</h1>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
                <ul class="nav navbar-nav nav-pos-right navbar-left">

                    <!-- Home Menu -->
                    <li>
                        <a href="{{route('cart')}}"  class="menu-item">
                            CART <span class="badge">{{ \Illuminate\Support\Facades\Session::has('cart') ? \Illuminate\Support\Facades\Session::get('cart')->totalQty : '' }}{{ \Illuminate\Support\Facades\Session::has('cartQty') ? \Illuminate\Support\Facades\Session::get('cartQty') : '' }}</span>
                        </a>
                        <!-- .mega-dropdown-menu end -->
                    </li>
                    <!-- Home Menu -->

                    @if(auth()->guard('web')->check())
                        <li>
                            <a href="{{route('orders')}}"  class="menu-item">My ORDER</a>
                            <!-- .mega-dropdown-menu end -->
                        </li>
                        <li>
                            <a href="{{route('logout')}}"  class="menu-item">LOGOUT</a>
                            <!-- .mega-dropdown-menu end -->
                        </li>
                    @else
                        <li>
                            <a href="{{route('login')}}"  class="menu-item">LOGIN</a>
                            <!-- .mega-dropdown-menu end -->
                        </li>
                    @endif
                </ul>
            </div>
            <!-- .navbar-collapse -->
        </div>
        <!-- .container end  -->
    </nav>

    <!-- Menu section MOBILE
    ============================================= -->
    <nav id="primary-menu" class="navbar navbar-fixed-top hidden-md hidden-lg">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->

            <!-- .navbar-collapse -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse-3" aria-expanded="false"
                        style="float: left;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo center" href="{{route('home')}}">
                    <img  src="{{ asset('images/icons/nama-brand-logo-black.png') }}" alt="Nama Logo">
                </a>

                @if(auth()->guard('web')->check())
                    <a href="{{route('logout')}}" class="navbar-toggle collapsed icon-header-responsive" style="float: right;">
                        <span class="sr-only">Toggle navigation</span>
                        <img src="{{asset('/images/icons/login.png')}}" style="width: 100%; height:100%;">
                    </a>
                @else
                    <a href="{{route('login')}}" class="navbar-toggle collapsed icon-header-responsive" style="float: right;">
                        <span class="sr-only">Toggle navigation</span>
                        <img src="{{asset('/images/icons/login.png')}}" style="width: 100%; height:100%;">
                    </a>
                @endif
                <a href="{{route('cart')}}" class="navbar-toggle collapsed icon-header-responsive"
                        style="float: right;">
                    <span class="sr-only">Toggle navigation</span>
                    <img src="{{asset('/images/icons/cart-image.png')}}" style="width: 100%; height:100%;">
                </a>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse-3">
                <!-- Module Shop -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a class="pointer">SHOP</a>
                    </div>
                    <div class="module-content module-fullscreen module--search2-box">
                        <div class="pos-vertical-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 center">
                                        <a href="{{route('product.list')}}"><H4 class="header-menu">SHOP ALL</H4></a>
                                        <a href="/product-list?category=1"><H4 class="header-menu">BAGS & TOTES</H4></a>
                                        <a href="/product-list?category=2"><H4 class="header-menu">WALLETS</H4></a>
                                        <a href="/product-list?category=3"><H4 class="header-menu">CARD HOLDERS</H4></a>
                                        <a href="/product-list?category=4"><H4 class="header-menu">POUCHES</H4></a>
                                        <a href="/product-list?category=5"><H4 class="header-menu">PHONE CASES</H4></a>
                                    </div><!-- .col-md-8 end -->
                                </div><!-- .row end -->
                            </div><!-- .container end -->
                        </div>
                        <a class="module-cancel pointer"><i class="fa fa-close"></i></a>
                    </div>
                </div><!-- .module-Shop end -->

                <!-- Module About -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        <a href="{{route('about.us')}}">ABOUT</a>
                    </div>
                </div><!-- .module-About end -->

                <!-- Module Contact -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a class="pointer">CONTACT</a>
                    </div>
                    <div class="module-content module-fullscreen module--search2-box">
                        <div class="pos-vertical-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12" style="padding: 0 1% 0 7%;">
                                        <h2>Contact</h2>
                                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                        <br/>
                                        {!! Form::open(array('action' => 'Frontend\HomeController@contact', 'id'=>'form-contact', 'class'=>'form-search2', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}

                                        <input type="text" class="form-control" name="name" id="name" placeholder="NAME" required/>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required/>
                                        <input type="text" class="form-control" name="order" id="order" placeholder="ORDER NUMBER (IF APPLICABLE)"/>
                                        <textarea class="form-control" name="message" id="message" rows="2" placeholder="MESSAGE" required></textarea>

                                        <div style="text-align: center;">
                                            <button type="submit" class="btn btn--secondary btn--bordered">SEND</button>
                                        </div>

                                        {!! Form::close() !!}
                                    </div><!-- .col-md-8 end -->
                                </div><!-- .row end -->
                            </div><!-- .container end -->
                        </div>
                        <a class="module-cancel pointer"><i class="fa fa-close"></i></a>
                    </div>
                </div><!-- .module-Contact end -->

                <!-- Module Search -->
                <div class="module module-search pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a class="pointer">SEARCH</a>
                    </div>
                    <div class="module-content module-fullscreen module--search-box">
                        <div class="pos-vertical-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 center">
                                        <h4>Search</h4>

                                        {!! Form::open(array('action' => 'Frontend\ProductController@search', 'id'=>'form-search', 'class'=>'form-search', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}

                                        <input type="text" class="form-control" id="search-text" name="search-text">
                                        <button class="btn search-button contact-button" type="button" onClick="empty()" >
                                            <i class="fa fa-long-arrow-right"></i>
                                        </button>

                                        {!! Form::close() !!}
                                    </div><!-- .col-md-8 end -->
                                </div><!-- .row end -->
                            </div><!-- .container end -->
                        </div>
                        <a class="module-cancel pointer"><i class="fa fa-close"></i></a>
                    </div>
                </div><!-- .module-search end -->

            </div>
        </div>
        <!-- .container end  -->
    </nav>

</header>


@section('scripts-footer-header')
    <script>
        function empty() {
            var x;
            x = document.getElementById("search-text").value;
            if (x == "" || x == null) {
            }
            else{
                $('#form-search').submit();
            }
        }
        $('#subscription_form').on('submit', function(e) {
            e.preventDefault();
            var name = $('#subscribe_name').val();
            var email = $('#subscribe_email').val();
            // alert(name);

            $.ajax({
                type: 'POST',
                url: '{{ route('newsletter') }}',
                datatype : "application/json",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'name': name,
                    'email': email
                }, // no need to stringify
                success: function (result) {
                    $('#subscribe_success_message').slideDown(500);
                }
            });
        });
    </script>
@endsection