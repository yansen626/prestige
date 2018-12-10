@extends('layouts.admin')

@section('content')

    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4> <i class="icon-table"></i> Products</h4>
                </div>
            </div>
        </div>
    </header>

    <div class="content-wrapper animatedParent animateOnce">
        <div class="container">
            <section class="paper-card">
                <div class="row">
                    <table class="table cell-vertical-align-middle  table-responsive mb-4">
                        <tbody>
                        <tr class="no-b">
                            <td>
                                <a href="#" class="btn btn-outline-primary btn-lg btn-block">
                                <i class="icon icon-plus"></i> Add
                                </a>
                            </td>
                            {{--<td>--}}
                                {{--<a href="#" class="btn btn-outline-primary btn-lg btn-block">--}}
                                {{--<i class="icon icon-report"></i> Report--}}
                                {{--</a>--}}
                            {{--</td>--}}
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-lg-12">
                        <table id="demoGrid" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>SKU</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Update At</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection