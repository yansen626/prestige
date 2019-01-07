@extends('layouts.frontend')

@section('content')

    <!-- Cover #5
    ============================================= -->
    <section id="cover5" class="section mtop-100 pt-0 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="padding-top: 5%;">
                    <h1>FAQ's</h1>
                    <hr>
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
                                    Product Specifications Product Specifications Product Specifications Product Specifications Product Specifications Product Specifications Product Specifications
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
                    </div>
                </div><!-- .col-md-6 end-->
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #cover5 end -->
@endsection
