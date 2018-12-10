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

    <div class="container-fluid relative animatedParent animateOnce">
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
                                                <label class="form-label">BankID *</label>
                                                <input id="BankId" type="text" class="form-control"
                                                       name="BankId" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">BankName *</label>
                                            <input id="BankName" name="BankName" type="text" value=""
                                                   style="text-transform: uppercase;" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group form-float form-group-lg">
                                        <div class="form-line">
                                            <label class="form-label">AccountNo *</label>
                                            <input id="AccountNo" name="AccountNo" type="text" value=""
                                                   style="text-transform: uppercase;" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="Notes">Notes</label>
                                        <textarea id="Notes" rows="5" class="form-control"
                                                  style="text-transform: uppercase;" name="Notes"></textarea>
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
    </div>
@endsection