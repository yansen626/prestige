
<footer id="footer" class="footer footer-1">
    <!-- Widget Section
    ============================================= -->
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 footer--widget footer--widget-about centered">
                    <div class="footer--widget-title">
                        <h2>nama.</h2>
                    </div>
                    <div class="footer--widget-content">

                        <div class="col-xs-12 col-sm-6 col-md-6 footer--widget footer--widget-about">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{route('others', ['type'=>'Term-Condition'])}}">T&C'S</a></li>
                                <li><a href="{{route('others', ['type'=>'FAQ'])}}">FAQ'S</a></li>
                                <li>SHIPPING</li>
                                <li><a href="{{route('others', ['type'=>'Privacy-Policy'])}}">PRIVACY</a></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 footer--widget footer--widget-about">
                            <ul class="list-unstyled mb-0">
                                <li>ABOUT</li>
                                <li>CONTACT</li>
                                <li>
                                    <img src="{{ asset('images/icons/nama-brand-pinterest.svg') }}" class="width-20">
                                    <img src="{{ asset('images/icons/nama-brand-instagram.svg') }}" class="width-20">
                                    <img src="{{ asset('images/icons/nama-brand-facebook.svg') }}" class="width-20">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- .col-md-3 end -->
                <div class="col-xs-12 col-sm-6 col-md-6 centered">
                    <div>
                        <h5>Join Our Newsletter</h5>
                    </div>
                    <div>
                        <form id="subscription_form">
                            <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}">

                            <input type="text" class="form-control" name="subscribe_name" id="subscribe_name" placeholder="Name" required/>
                            <input type="email" class="form-control" name="subscribe_email" id="subscribe_email" placeholder="Email" required/>
                            <button type="submit" class="newsletter-button"><i class="fa fa-long-arrow-right"></i></button>
                        </form>
                        <div id="subscribe_success_message" class="row mb-3" style="display: none;">
                            <div class="col-12">
                                <h5 class="text-center">Thank You for Registering</h5>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <p>
                            COPYRIGHT 2019 NAMA LEATHER GOODS
                        </p>
                    </div>
                </div><!-- .col-md-3 end -->
            </div>
        </div><!-- .container end -->
    </div><!-- .footer-widget end -->

</footer>

