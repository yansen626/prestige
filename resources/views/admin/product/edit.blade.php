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

    {{ Form::open(['route'=>['admin.product.store'],'method' => 'post','id' => 'general-form','enctype' => 'multipart/form-data']) }}

    <div class="content-wrapper animatedParent animateOnce">
        <div class="container">
            <section class="paper-card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body b-b">
                                <!-- Input -->
                                <div class="body">

                                    <canvas id="myCanvas" width="600" height="600"></canvas>

                                    <input id="text" name="text" type="text" value="" onkeyup="changeText()" class="form-control">
                                    <input id="img_data" name="img_data" type="hidden" value="" class="form-control">

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
@section('scripts')
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        function changeText(){
            var text = $('#text').val();
            var canvas = document.getElementById("myCanvas");
            var context = canvas.getContext("2d");
            var imageObj = new Image();
            imageObj.onload = function(){
                context.drawImage(imageObj, 10, 10);
                context.font = "20pt Calibri";
                context.fillStyle = "#fff";
                context.fillText(text, 250, 300);
            };

            imageObj.src = "{{ asset('img/tas.jpg') }}";

            var dataURL = canvas.toDataURL();
            $('#img_data').val(dataURL);
        }
        {{--window.onload = function(){--}}
            {{--var canvas = document.getElementById("myCanvas");--}}
            {{--var context = canvas.getContext("2d");--}}
            {{--var imageObj = new Image();--}}
            {{--imageObj.onload = function(){--}}
                {{--context.drawImage(imageObj, 10, 10);--}}
                {{--context.font = "20pt Calibri";--}}
                {{--context.fillStyle = "#fff";--}}
                {{--context.fillText("My TEXT!", 250, 300);--}}
            {{--};--}}

            {{--imageObj.src = "{{ asset('img/tas.jpg') }}";--}}
        {{--};--}}
    </script>
@endsection
