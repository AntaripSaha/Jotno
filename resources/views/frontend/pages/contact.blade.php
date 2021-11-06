@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/contact.css') }}">
@endsection

@section('body-content')
<div class="loading">Loading&#8230;</div>

<!-- main content start -->
<div class="content" style="min-height: 201px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters">

                        <!-- left part start -->
                        <div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Message Us</h3>
                                <div id="form-message-warning" class="mb-4"></div>
                                <form method="post" action="{{ route('contact.send') }}" id="contactForm" name="contactForm" class="ajax-form">
                                    @csrf
                                    <div class="row">

                                        <!-- name -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="label">
                                                    Name*
                                                </label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                        </div>

                                        <!-- email -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="label">
                                                    Email*
                                                </label>
                                                <input type="text" name="email" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="label">
                                                    Phone*
                                                </label>
                                                <input type="text" name="phone" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Subject -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label">
                                                    Subject*
                                                </label>
                                                <input type="text" name="subject" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Message -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label">
                                                Message*
                                                </label>
                                                <textarea name="message" rows="4" class="form-control">
                                                </textarea>
                                            </div>
                                        </div>

                                        <!-- send sms -->
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <input type="submit" value="Send Message" class="send_sms">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- left part end -->

                        <!-- right part start -->
                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap w-100 p-md-5 p-4 contact-info">
                                <h3>Let's get in touch</h3>
                                <p class="mb-4">
                                    We're open for any suggestion or just to have a
                                    chat
                                </p>
                                <ul>
                                    <li>
                                        <p class="info-left">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </p>
                                        <p class="info-right"> 
                                            {{ $app_info->address }}
                                        </p>
                                    </li>
                                    <li>
                                        <p class="info-left">
                                            <i class="fas fa-envelope"></i>
                                        </p>
                                        <p class="info-right"> 
                                            {{ $app_info->email }}
                                        </p>
                                    </li>
                                    <li>
                                        <p class="info-left">
                                            <i class="fa fa-phone-alt"></i>
                                        </p>
                                        <p class="info-right"> 
                                            +88-{{ $app_info->phone }}
                                        </p>
                                    </li>
                                </ul>
                                <div class="contact-social">
                                    <a href="{{ $app_info->tw }}">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="{{ $app_info->fb }}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="{{ $app_info->in }}">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- right part end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main content end -->

@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>
@endsection
