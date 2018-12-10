@extends('layouts.admin')

@section('content')

    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4> <i class="icon-table"></i> New Product</h4>
                </div>
            </div>
        </div>
    </header>

    {{ Form::open(['route'=>['admin.product.store'],'method' => 'post','id' => 'general-form']) }}

    <div class="content-wrapper animatedParent animateOnce">
        <div class="container">
            <section class="paper-card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body b-b">
                                <!-- Input -->
                                <div class="body">
                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group form-float form-group-lg">
                                                <div class="form-line">
                                                    <label class="form-label">Product Name *</label>
                                                    <input id="name" type="text" class="form-control" name="name" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">SKU *</label>
                                                <input id="sku" name="sku" type="text" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="Description">Description</label>
                                            <textarea id="Description" rows="5" class="form-control" name="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">Qty *</label>
                                                <input id="qty" name="qty" type="number" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">Price *</label>
                                                <input id="price" name="price" type="number" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">Weight *</label>
                                                <input id="price" name="price" type="number" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">Width *</label>
                                                <input id="price" name="price" type="number" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">Height *</label>
                                                <input id="price" name="price" type="number" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">Length *</label>
                                                <input id="price" name="price" type="number" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input id="meta_title" name="meta_title" type="text" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Title</label>
                                            <textarea id="meta_description" rows="5" class="form-control"
                                                      style="text-transform: uppercase;" name="meta_description"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-11 col-sm-11 col-xs-12" style="margin: 3% 0 3% 0;">
                                        <a href="#" class="btn btn-danger">Exit</a>
                                        <input type="submit" class="btn btn-success" value="Save">
                                    </div>
                                </div>

                                <!-- #END# Input -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    {{ Form::close() }}
@endsection