@extends('layouts.frontend')

@section('content')

    <!-- Contact #3
============================================= -->
    <section id="contact3" class="contact contact-3 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="heading heading-2 mb-60">
                        {{--<h2 class="heading--title">Contact Us</h2>--}}
                        <h1>Contact Us</h1>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                    </div>
                    <div class=" clearfix"></div>
                    <div class="contact-form">

                        {!! Form::open(array('action' => 'Frontend\HomeController@contact', 'id'=>'mb-0', 'class'=>'form-search2', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data', 'novalidate')) !!}

                        <div class="row">
                            <div class="col-md-6">
                                {{--<textarea class="form-control" name="message" id="message" rows="0" placeholder="FIRST NAME" required></textarea>--}}
                                <input type="text" class="form-control" name="first_name" id="name" placeholder="FIRST NAME" required/>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" id="name" placeholder="LAST NAME" required/>
                            </div>
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required/>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="order" id="order" placeholder="ORDER NO"/>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" id="message" rows="2" placeholder="MESSAGE" required style="line-height: 25px !important;"></textarea>
                                {{--<textarea class="form-control" name="contact-message" id="message" rows="2" placeholder="Message" required></textarea>--}}
                            </div>
                            <div class="col-md-12" style="text-align: center;">
                                <button type="submit" class="btn btn--secondary btn--bordered">SEND</button>
                                {{--<input type="submit" value="Send Message" name="SEND" class="btn btn--secondary btn--block">--}}
                            </div>
                        </div>
                        {{--<input type="text" class="form-control" name="name" id="name" placeholder="NAME" required/>--}}
                        {{--<input type="email" class="form-control" name="email" id="email" placeholder="EMAIL ADDRESS" required/>--}}
                        {{--<input type="text" class="form-control" name="order" id="order" placeholder="ORDER NUMBER (IF APPLICABLE)"/>--}}
                        {{--<textarea class="form-control" name="message" id="message" rows="2" placeholder="MESSAGE" required></textarea>--}}

                        {{--<div style="text-align: center;">--}}
                        {{--<button type="submit" class="btn btn--secondary btn--bordered">SEND</button>--}}
                        {{--</div>--}}

                        {!! Form::close() !!}
                    </div>
                </div><!-- .col-md-6 end -->
                <div class="col-xs-12 col-sm-12 col-md-6 padding-top-mobile">
                    <div class="heading heading-2 mb-60">
                        <h1>Get in Touch</h1>
                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                        <p class="mt-20 font-16" style="text-align: justify;">Need help? Do you have a question about your order or just simply want to say hi? Please don’t hesitate to shoot us a message at hi@nama-official.com</p>
                    </div>
                    <div class=" clearfix"></div>
                    {{--<div class="row mb-50">--}}
                        {{--<div class="col-xs-12 col-sm-6 col-md-6">--}}
                            {{--<div class="contact--info center">--}}
                                {{--<img src="{{asset('/images/icons/address.png')}}" style="width: 20%; height:100%;">--}}
                                {{--<p><br>Alnahas Building, 2 AlBahr St, Tanta</p>--}}
                                {{--<p>AlGharbia, Egypt.</p>--}}
                            {{--</div>--}}
                        {{--</div><!-- .col-md-6 end -->--}}
                        {{--<div class="col-xs-12 col-sm-6 col-md-6">--}}
                            {{--<div class="contact--info center">--}}
                                {{--<img src="{{asset('/images/icons/phone.png')}}" style="width: 20%; height:100%;">--}}
                                {{--<p><br>Office Telephone : 002 01065370701</p>--}}
                                {{--<p>Mobile : 002 01065370701</p>--}}
                            {{--</div>--}}
                        {{--</div><!-- .col-md-6 end -->--}}
                    {{--</div><!-- .row end -->--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-12 col-sm-6 col-md-6">--}}
                            {{--<div class="contact--info center">--}}
                                {{--<img src="{{asset('/images/icons/mail.png')}}" style="width: 20%; height:100%;">--}}
                                {{--<p><br>Main Email : Main@nama-official.com</p>--}}
                                {{--<p>Inquiries : Info@nama-official.com</p>--}}
                            {{--</div>--}}
                        {{--</div><!-- .col-md-6 end -->--}}
                        {{--<div class="col-xs-12 col-sm-6 col-md-6">--}}
                            {{--<div class="contact--info center">--}}
                                {{--<img src="{{asset('/images/icons/support.png')}}" style="width: 20%; height:100%;">--}}
                                {{--<p><br>Support : Support@nama-official.com</p>--}}
                                {{--<p>Sales : Sales@nama-official.com</p>--}}
                            {{--</div>--}}
                        {{--</div><!-- .col-md-6 end -->--}}
                    {{--</div>--}}
                </div><!-- .col-md-6 end -->
            </div>
        </div>
    </section>
    <!-- #contact1 end -->

    {{--<!-- Contact--}}
    {{--============================================= -->--}}
    {{--<section id="contact" class="contact pb-0 pt-0">--}}
        {{--<div class="container-fluid pr-0 pl-0">--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-12  col-sm-12  col-md-12 pr-0 pl-0">--}}
                    {{--<div id="googleMap" style="width:100%;height:498px;">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section><!-- #contact end -->--}}
@endsection
@section('styles')
    <style>
        .contact--info p{
            color:black;
        }
    </style>
@endsection
@section('scripts')
    {{--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&amp;key=AIzaSyCiRALrXFl5vovX0hAkccXXBFh7zP8AOW8"></script>--}}
    {{--<script type="text/javascript" src="assets/js/plugins/jquery.gmap.min.js"></script>--}}
    {{--<script type="text/javascript">--}}

        {{--$('#googleMap').gMap({--}}
            {{--address: "121 King St,Melbourne, Australia",--}}
            {{--zoom: 20,--}}
            {{--markers:[--}}
                {{--{--}}
                    {{--address: "Melbourne, Australia",--}}
                    {{--maptype:'ROADMAP',--}}
                    {{--icon: {--}}
                        {{--image: "assets/images/gmap/maker.png",--}}
                        {{--iconsize: [35, 35],--}}
                        {{--iconanchor: [17,35]--}}
                    {{--}--}}
                {{--}--}}
            {{--]--}}
        {{--});--}}
    {{--</script>--}}
@endsection