@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
@endsection

@section('body-content')
<div class="loading">Loading&#8230;</div>
<div class="content" style="min-height: 201px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="{{ asset('frontend/img/login-banner.jpg') }}" class="img-fluid"
                                alt="Doccure Login">
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>
                                    Password Email
                                </h3>
                                <small>
                                    We will send you a password reset link in your email address
                                </small>

                                @if( session()->has('error') )
                                <p class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </p>
                                @endif

                            </div>
                            <form class="ajax-form" action="{{ route('frontend.post.email') }}" method="post">
                                @csrf

                                <!-- email -->
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="email">
                                    <label class="focus-label">Email</label>
                                </div>

                                <!-- login -->
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Send</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>
@endsection
