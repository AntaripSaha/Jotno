@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<style>
    .password-box {
        position: relative;
    }

    .password-box .hide-password {
        display: none;
    }

    .password-box .fas {
        position: absolute;
        top: 35%;
        right: 15px;
        z-index: 10;
        cursor: pointer;
    }
</style>
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
                                    Login<a class="forgot-link" href="{{ route('register') }}">Don’t have an
                                        account?</a>
                                </h3>
                            </div>
                            <form class="ajax-form" action="{{ route('do.frontend.login') }}" method="post">
                                @csrf

                                <!-- email -->
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="email">
                                    <label class="focus-label">Email</label>
                                </div>

                                <!-- password -->
                                <div class="form-group form-focus password-box">
                                    <i class="fas fa-eye show-password"></i>
                                    <i class="fas fa-eye-slash hide-password"></i>
                                    <input type="password" class="form-control floating" name="password" id="password-field">
                                    <label class="focus-label">Password</label>
                                </div>

                                <!-- forget password -->
                                <div class="text-right">
                                    <a class="forgot-link" href="{{ route('frontend.get.email') }}">Forgot Password ?</a>
                                </div>

                                <!-- login -->
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
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


<script>
    $(".show-password").click(function () {
        let $this = $(this)
        $this.closest(".password-box").find("#password-field").attr("type", "text")
        $this.closest(".password-box").find(".show-password").hide()
        $this.closest(".password-box").find(".hide-password").show()
    })

    $(".hide-password").click(function () {
        let $this = $(this)
        $this.closest(".password-box").find("#password-field").attr("type", "password")
        $this.closest(".password-box").find(".show-password").show()
        $this.closest(".password-box").find(".hide-password").hide()
    })

</script>

@endsection
