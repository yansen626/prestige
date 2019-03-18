@extends('layouts.frontend')

@section('content')

    <!-- Cover #5
    ============================================= -->
    <section id="cover5" class="section mtop-100 pt-0 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2" style="padding-top: 5%;padding-bottom: 5%;text-align: justify;">
                    <h1>T&C's</h1>
                    <hr>
                    <!-- Accordion #1
                    ============================================= -->
                    <div id="accordion1">
                        <div class="accordion accordion-1" id="accordion01">
                            <!-- Panel 01 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-1">
                                        Register and Subscribe
                                    </a>
                                </div>
                                <div id="collapse01-1" class="panel--body panel-collapse collapse in">
                                    Registering an account with us not only will make your shopping experience more convenient, but also you will receive latest updates that’s going on in Nama. By registering, you don’t have to enter your address every time you have a transaction since it will already be saved under your account. Other than that, you can track your orders, as well as review your past orders with us.  Therefore, make sure the information you entered are accurate.
                                    We assure you that your information will be kept private and secured in our system.
                                </div>
                            </div>

                            <!-- Panel 01 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-2">
                                        Orders
                                    </a>
                                </div>
                                <div id="collapse01-2" class="panel--body panel-collapse collapse">
                                    All products are available for order as long as they are still available. Please note that adding items to cart does not mean it will be reserved for you. The items are only reserved when the product has been purchased.

                                    We reserve the right not to process your order in the case that we are unable to validate the payment. In the case of system error or out of stock items, we will do a full refund.
                                </div>
                            </div>

                            <!-- Panel 03 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-3">
                                        Pricing Rule
                                    </a>
                                </div>
                                <div id="collapse01-3" class="panel--body panel-collapse collapse">
                                    Prices shown in our website are in Indonesian Rupiah. Prices may change without any notifications.

                                    Customers purchasing outside Indonesia can pay via Bank Transfer. However, we suggest customers from overseas to pay in USD via PayPal or through Western Union.

                                    Any custom and tax costs will be invoiced to you directly from the shipping company.
                                </div>
                            </div>

                            <!-- Panel 04 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-4">
                                        Product Color
                                    </a>
                                </div>
                                <div id="collapse01-4" class="panel--body panel-collapse collapse">
                                    We try our best to give the most accurate depiction of product colors, however due to different monitor displays, product colors may appear slightly different than in screens.
                                </div>
                            </div>

                            <!-- Panel 05 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-5">
                                        Payment & Confirmation
                                    </a>
                                </div>
                                <div id="collapse01-5" class="panel--body panel-collapse collapse">
                                    Payment can be made via Bank Transfer (BCA), Paypal, Western Union, Midtrans (visa and mastercard)

                                    Payment has to be made in 24 hours after checking out or else the order will automatically be cancelled. We will send an electronic invoice with the details of your order via email.

                                    You will have to confirm your payment in your account after you have made the payment. If you have any trouble doing so, please don’t hesitate to contact us at hi@nama-official.com

                                    Confirmation (only for Bank Transfer) should be made strictly after you have paid your order. You can make the confirmation easily by clicking on the 'CONFIRM PAYMENT' link. Be sure to keep your order ID so you can confirm your order.

                                    You do not need to confirm your payment if you pay with Credit Card.
                                    Bank Account Information
                                    BCA: 0066 12 1555  BELINDA TJAJADI
                                </div>
                            </div>

                            <!-- Panel 06 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-6">
                                        Return & Exchange Policy
                                    </a>
                                </div>
                                <div id="collapse01-6" class="panel--body panel-collapse collapse">
                                    Since we are custom merchandise, therefore all sales are final and cannot be returned or refunded. We accept returns for refunds or exchange if the item is defective or does not match its description.
                                </div>
                            </div>

                            <!-- Panel 07 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-7">
                                        Intellectual Property Rights
                                    </a>
                                </div>
                                <div id="collapse01-7" class="panel--body panel-collapse collapse">
                                    All content in Nama Official website including software and all HTML and codes are not permitted for any public use. Content includes any graphic, logos, photographs, image rights, video or text displayed at www.nama-official.com. Any reproduction, copying, or foregoing of the content are prohibited.
                                </div>
                            </div>

                            <!-- Panel 08 -->
                            <div class="panel">
                                <div class="panel--heading">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion01" href="#collapse01-8">
                                        Agreement and Compensation
                                    </a>
                                </div>
                                <div id="collapse01-8" class="panel--body panel-collapse collapse">
                                    You agree that you will be responsible for your activity in the website. If we notice that you were involved in prohibited activities or violations in our Terms and Conditions, we may deny your access to the website on temporary or permanent basis. We are not responsible for our losses that are caused outside of our control, such as by shipping company or force majeure. We will be responsible for losses only if we violate our Terms and Conditions.
                                </div>
                            </div>
                        </div>
                        <!-- End .Accordion-->
                    </div>
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
        .accordion .panel .panel--body {
            padding: 0 0 5%;
        }
    </style>
@endsection
