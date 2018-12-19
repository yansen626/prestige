
<header id="navbar-spy" class="header header-13 header-topbar header-light header-fixed">
    <div id="top-bar" class="top-bar">
        <div class="container">
            <div class="bottom-bar-border">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 top--contact hidden-xs center color-black">
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

    <!-- Menu section
    ============================================= -->
    <nav id="primary-menu" class="navbar navbar-fixed-top">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse-2">
                <!-- Module Shop -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a href="#">SHOP</a>
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
                        <a class="module-cancel" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div><!-- .module-Shop end -->

                <!-- Module About -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a href="#">ABOUT</a>
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

                <!-- Module Contact -->
                <div class="module module-search2 pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a href="#">CONTACT</a>
                    </div>
                    <div class="module-content module-fullscreen module--search2-box">
                        <div class="pos-vertical-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6" style="padding: 0 1% 0 7%;">
                                        <h2>Contact</h2>
                                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                        <br/>
                                        <form class="form-search2">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="NAME" required/>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required/>
                                            <input type="text" class="form-control" name="order" id="order" placeholder="ORDER NUMBER (IF APPLICABLE)" required/>
                                            <textarea class="form-control" name="message" id="message" rows="2" placeholder="MESSAGE" required></textarea>

                                            <div style="text-align: center;">
                                                <button type="submit" class="btn btn--secondary btn--bordered">SEND</button>
                                            </div>
                                        </form><!-- .form-search end -->
                                    </div><!-- .col-md-8 end -->
                                </div><!-- .row end -->
                            </div><!-- .container end -->
                        </div>
                        <a class="module-cancel" href="#"><i class="fa fa-close"></i></a>
                    </div>
                </div><!-- .module-Contact end -->

                <!-- Module Search -->
                <div class="module module-search pull-left">
                    <div class="module-icon search-icon color-black">
                        {{--<i class="fa fa-search"></i>--}}
                        {{--<span class="title">search</span>--}}
                        <a href="#">SEARCH</a>
                    </div>
                    <div class="module-content module-fullscreen module--search-box">
                        <div class="pos-vertical-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 center">
                                        <h4>Search</h4>

                                        {!! Form::open(array('action' => 'Frontend\ProductController@search', 'id'=>'form-search', 'class'=>'form-search', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}

                                        <input type="text" class="form-control" id="search-text" name="search-text">
                                        <button class="btn search-button" type="button" onClick="empty()" >
                                            <i class="fa fa-long-arrow-right"></i>
                                        </button>

                                        {!! Form::close() !!}
                                    </div><!-- .col-md-8 end -->
                                </div><!-- .row end -->
                            </div><!-- .container end -->
                        </div>
                        <a class="module-cancel" href="#"><i class="fa fa-close"></i></a>
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
                <a class="logo" href="#">
                    {{--<img class="logo-light" src="{{ asset('images/icons/nama-brand-logo.svg') }}" alt="Nama Logo">--}}
                    {{--<img class="logo-dark" src="{{ asset('images/icons/nama-brand-logo.svg') }}" alt="Nama Logo">--}}
                    <img  src="{{ asset('images/icons/nama-brand-logo-black.png') }}" alt="Nama Logo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
                <ul class="nav navbar-nav nav-pos-right navbar-left">

                    <!-- Home Menu -->
                    <li class="has-dropdown mega-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">CART</a>
                        <!-- .mega-dropdown-menu end -->
                    </li>
                </ul>
            </div>
            <!-- .navbar-collapse -->
        </div>
        <!-- .container end  -->
    </nav>

</header>


@section('scripts')
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
    </script>
@endsection