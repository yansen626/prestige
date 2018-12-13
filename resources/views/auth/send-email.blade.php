@extends('layouts.frontend')

@section('content')
    <section id="page-title" class="page-title">
        <div class="container-fluid bg-overlay bg-overlay-theme">
            <div class="bg-section">
                <img src="{{ asset('images/page-title/title-1.jpg') }}" alt="Background"/>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="title title-1 text--center">
                        <div class="title--content">
                            <div class="title--heading">
                                <h1>Email Verification</h1>
                            </div>
                        </div>
                    </div><!-- .page-title end -->
                </div><!-- .col-md-12 end -->
            </div><!-- .row end -->
        </div><!-- .container end -->
    </section><!-- #page-title end -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Email Verification</div>
                    <div class="card-body">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="comment-form-wrapper contact-from clearfix">
                                <div class="widget-title ">
                                    <p>We have send Verification Email to </p>
                                    <p>Kindly check your mail box or Spam Folder</p>
                                    <p>If in 5 minutes you haven't receive our E-Mail, Please Click the link Below
                                        <a href="#">Here</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection