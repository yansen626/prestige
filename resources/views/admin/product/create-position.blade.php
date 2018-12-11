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

    <div class="content-wrapper animatedParent animateOnce">
        <div class="container">
            <section class="paper-card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body b-b">

                                <h3 class="my-3">
                                    Step 2 (image)
                                </h3>
                                <h3 class="my-3">
                                    Product = {{$product->name}}
                                </h3>

                                <div class="container-fluid animatedParent animateOnce my-3">
                                    <div class="animated fadeInUpShort">
                                        <!-- Input -->
                                        {{ Form::open(['route'=>['admin.product.store'],'method' => 'post','id' => 'general-form']) }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Upload Main Image *</label>
                                                        {{--<input type="file" name="PhotoPosted" id="PhotoPosted" class="file-loading">--}}
                                                        {!! Form::file('main_image', array('id' => 'main_image', 'class' => 'file-loading', 'accept' => 'image/*,application/pdf')) !!}
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <img id='img-upload' style="width:500px; height:500px;"/>
                                                        <canvas id="canvas" width=300 height=300></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <input id="theText" type="text">
                                                        <a id="submit">Check Position</a><br>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">X</label>
                                                        <input id="position_x" name="position_x" type="number" value="" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
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
                                    {{ Form::close() }}
                                    <!-- #END# Input -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
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

        // CANVAS JAVASCRIPT

        // canvas related variables
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");

        // variables used to get mouse position on the canvas
        var $canvas = $("#canvas");
        var canvasOffset = $canvas.offset();
        var offsetX = canvasOffset.left;
        var offsetY = canvasOffset.top;
        var scrollX = $canvas.scrollLeft();
        var scrollY = $canvas.scrollTop();

        // variables to save last mouse position
        // used to see how far the user dragged the mouse
        // and then move the text by that distance
        var startX;
        var startY;

        // an array to hold text objects
        var texts = [];

        // this var will hold the index of the hit-selected text
        var selectedText = -1;

        // clear the canvas & redraw all texts
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (var i = 0; i < texts.length; i++) {
                var text = texts[i];
                ctx.fillText(text.text, text.x, text.y);
            }
        }

        // test if x,y is inside the bounding box of texts[textIndex]
        function textHittest(x, y, textIndex) {
            var text = texts[textIndex];
            return (x >= text.x && x <= text.x + text.width && y >= text.y - text.height && y <= text.y);
        }

        // handle mousedown events
        // iterate through texts[] and see if the user
        // mousedown'ed on one of them
        // If yes, set the selectedText to the index of that text
        function handleMouseDown(e) {
            e.preventDefault();
            startX = parseInt(e.clientX - offsetX);
            startY = parseInt(e.clientY - offsetY);
            // Put your mousedown stuff here
            for (var i = 0; i < texts.length; i++) {
                if (textHittest(startX, startY, i)) {
                    selectedText = i;
                }
            }
        }

        // done dragging
        function handleMouseUp(e) {
            e.preventDefault();
            selectedText = -1;
        }

        // also done dragging
        function handleMouseOut(e) {
            e.preventDefault();
            selectedText = -1;
        }

        // handle mousemove events
        // calc how far the mouse has been dragged since
        // the last mousemove event and move the selected text
        // by that distance
        function handleMouseMove(e) {
            if (selectedText < 0) {
                return;
            }
            e.preventDefault();
            mouseX = parseInt(e.clientX - offsetX);
            mouseY = parseInt(e.clientY - offsetY);

            // Put your mousemove stuff here
            var dx = mouseX - startX;
            var dy = mouseY - startY;
            startX = mouseX;
            startY = mouseY;

            var text = texts[selectedText];
            text.x += dx;
            text.y += dy;
            draw();
        }

        // listen for mouse events
        $("#canvas").mousedown(function (e) {
            handleMouseDown(e);
        });
        $("#canvas").mousemove(function (e) {
            handleMouseMove(e);
        });
        $("#canvas").mouseup(function (e) {
            handleMouseUp(e);
        });
        $("#canvas").mouseout(function (e) {
            handleMouseOut(e);
        });

        $("#submit").click(function () {

            // calc the y coordinate for this text on the canvas
            var y = texts.length * 20 + 20;

            // get the text from the input element
            var text = {
                text: $("#theText").val(),
                x: 20,
                y: y
            };

            // calc the size of this text for hit-testing purposes
            ctx.font = "16px verdana";
            text.width = ctx.measureText(text.text).width;
            text.height = 16;

            // put this new text in the texts array
            texts.push(text);

            // redraw everything
            draw();

        });
        // CANVAS JAVASCRIPT END
    </script>

@endsection