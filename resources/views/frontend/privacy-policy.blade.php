@extends('layouts.frontend')

@section('content')

    <!-- Cover #5
    ============================================= -->
    <section id="cover5" class="section mtop-100 pt-0 pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" style="padding-top: 5%;">
                    <h1>Privacy Policy</h1>
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
                                    <span>Enter personalized text (max 8 characters)</span>
                                    <span>&nbsp;</span>
                                    <form>
                                        <input type="text" class="form-control auto-blur"
                                               name="custom-text" id="custom-text" placeholder="TEXT HERE" maxlength="8"
                                               onfocusout="ChangePosition()" style="text-transform:uppercase" />
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <p style="margin-bottom: 0;margin-left: 11%;">Choose Font</p>
                                            <select class="minimal" data-width="auto" id="custom-font" name="custom-font" onchange="ChangePosition()">
                                                <option value="Serif">SERIF</option>
                                                <option value="Sans-serif">SAN SERIF</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <p style="margin-bottom: 0;margin-left: 11%;">Choose Color</p>
                                            <select class="selectpicker minimal" data-width="auto" id="custom-color" name="custom-color" onchange="ChangePosition()">
                                                <option value="Gold-FFD700">GOLD</option>
                                                <option value="Silver-C0C0C0">SILVER</option>
                                                <option value="Bronze-CD7F32">BRONZE</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <p style="margin-bottom: 0;margin-left: 11%;">Choose Size</p>
                                            <select class="selectpicker minimal" data-width="auto" id="custom-size" name="custom-size" onchange="ChangePosition()">
                                                <option value="Large-24">LARGE</option>
                                                <option value="Medium-20">MEDIUM</option>
                                                <option value="Small-16">SMALL</option>
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
                    </div>
                </div><!-- .col-md-6 end-->
            </div>
            <!-- .row end -->
        </div>
        <!-- .container end -->
    </section>
    <!-- #cover5 end -->
@endsection
