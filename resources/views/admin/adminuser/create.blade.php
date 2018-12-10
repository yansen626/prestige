@extends('layouts.admin')

@section('content')

<header class="blue accent-3 relative">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-package"></i>
                    Create New Division
                </h4>
            </div>
        </div>
    </div>
</header>

<form method="POST" action="{{ route('admin-users.store') }}">
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body b-b">
                        <div class="tab-content pb-3" id="v-pills-tabContent">
                            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                                <!-- Input -->
                                <div class="body">
                                    <div class="col-sm-12">
                                        <div class="form-check mb-2 mr-sm-2">
                                            <input type="checkbox" id="is_super_admin" name="is_super_admin" value="true" class="form-check-input"/>
                                            <label class="form-check-label" for="is_super_admin">
                                                Superadmin
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label" for="email">Email *</label>
                                                <input id="email" type="email" class="form-control"
                                                       name="email" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label" for="password">Password *</label>
                                                <input id="password" type="password" class="form-control"
                                                       name="password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label" for="password_confirmation">Password Confirmation *</label>
                                                <input id="password_confirmation" type="password" class="form-control"
                                                       name="password_confirmation" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label" for="first_name">First Name *</label>
                                                <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float form-group-lg">
                                            <div class="form-line">
                                                <label class="form-label" for="last_name">Last Name *</label>
                                                <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="role">Role *</label>
                                            <select id="role" name="role" class="form-control"></select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status *</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="2">Not Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11 col-sm-11 col-xs-12" style="margin: 3% 0 3% 0;">
                                    <a href="{{ route('admin-users') }}" class="btn btn-danger">Exit</a>
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
</form>
@endsection

@section('styles')
    <link href="{{ asset('css/select2-bootstrap4.min.css') }}" rel="stylesheet"/>
    <style>
        .select2-container--default .select2-search--dropdown::before {
            content: "";
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">

        $('#role').select2({
            placeholder: {
                id: '-1',
                text: 'Pilih Role...'
            },
            width: '100%',
            minimumInputLength: 0,
            ajax: {
                url: '{{ route('select.roles') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
    </script>
@endsection