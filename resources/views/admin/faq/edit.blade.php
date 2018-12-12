@extends('layouts.admin')

@section('content')

    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Edit FAQ
                    </h4>
                </div>
            </div>
        </div>
    </header>

    {{ Form::open(['route'=>['admin.faqs.update'],'method' => 'post','id' => 'general-form']) }}
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body b-b">
                        <div class="tab-content pb-3" id="v-pills-tabContent">
                            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                                @include('partials.admin._messages')
                                @foreach($errors->all() as $error)
                                    <ul>
                                        <li>
                                            <span class="help-block">
                                                <strong style="color: #ff3d00;"> {{ $error }} </strong>
                                            </span>
                                        </li>
                                    </ul>
                            @endforeach
                            <!-- Input -->
                                <div class="body">

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label for="header">Header *</label>
                                                <input id="header" type="text" class="form-control"
                                                       name="header" value="{{ $faq->header }}">
                                                <input type="hidden" value="{{ $faq->id }}" name="id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label for="my-summernote">Description *</label>
                                                <textarea id="my-summernote" name="description">{{ $faq->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-11 col-sm-11 col-xs-12" style="margin: 3% 0 3% 0;">
                                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-danger">Exit</a>
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                                <!-- #END# Input -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('styles')

    <link href="{{ asset('css/select2-bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
        /*placeholder style*/

        .note-placeholder {
            position: absolute;
            top: 20%;
            left: 5%;
            font-size: 2rem;
            color: #e4e5e7;
            pointer-events: none;
        }

        /*Toolbar panel*/

        .note-editor .note-toolbar {
            background: #f0f0f1;
            border-bottom: 1px solid #c2cad8;
            -webkit-box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.14), 0 3px 4px 0 rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.14), 0 3px 4px 0 rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
        }

        /*Buttons from toolbar*/

        .summernote .btn-group, .popover-content .btn-group {
            background: transparent;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .note-popover {
            background: #f0f0f1!important;
        }

        .summernote .btn, .note-btn {
            color: rgba(0, 0, 0, .54)!important;
            background-color: transparent!important;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .summernote .dropdown-toggle:after {
            vertical-align: middle;
        }

        .note-editor.card {
            -webkit-box-shadow: none;
            box-shadow: none;
            border-radius: 2px;
        }

        /* Border of the Summernote textarea */

        .note-editor.note-frame {
            border: 1px solid rgba(0, 0, 0, .14);
        }

        /* Padding of the text in textarea */

        .note-editor.note-frame .note-editing-area .note-editable {
            padding-top: 1rem;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#my-summernote').summernote({
            minHeight: 200,
            placeholder: 'Write here ...',
            focus: false,
            airMode: false,
            fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
            fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['style', 'ul', 'ol', 'paragraph']],
                ['fontsize', ['fontsize']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['height', ['height']],
                ['misc', ['undo', 'redo', 'print', 'help', 'fullscreen']]
            ],
            popover: {
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']]
                ]
            },
            print: {
                //'stylesheetUrl': 'url_of_stylesheet_for_printing'
            }
        });
        $('#my-summernote2').summernote({airMode: true,placeholder:'Try the airmode'});
    </script>
@endsection