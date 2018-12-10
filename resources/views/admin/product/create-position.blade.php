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
                                                    <label class="form-label">Upload Image *</label>
                                                    {{--<input type="file" name="PhotoPosted" id="PhotoPosted" class="file-loading">--}}
                                                    {!! Form::file('main_image', array('id' => 'main_image', 'class' => 'file-loading', 'accept' => 'image/*,application/pdf')) !!}
                                                </div>

                                                <img id='img-upload' style="width:500px; height:500px;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">X</label>
                                                <input id="position_x" name="position_x" type="number" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label">Y</label>
                                                <input id="position_y" name="position_y" type="number" value="" class="form-control">
                                            </div>
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

@section('styles')
    <link href="{{ URL::asset('css/fileinput.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/fileinput.js') }}"></script>
    <script>
        // FILEINPUT
        $("#main_image")
            .fileinput({
                allowedFileExtensions: ["jpg", "jpeg", "png"],
                showUpload: false,
                showPreview: false
            });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#main_image").change(function(){
            readURL(this);
        });
    </script>

@endsection