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
        top: 60%;
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
                                    Enter Your Password
                                </h3>
                            </div>
                            <form class="ajax-form" action="{{ route('frontend.password.reset',['email' => $email, 'token' => $token]) }}" method="post">
                                @csrf

                                <div class="form-group password-box">
                                    <i class="fas fa-eye show-password"></i>
                                    <i class="fas fa-eye-slash hide-password"></i>
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="password-field">
                                </div>
                                <div class="form-group password-box">
                                    <i class="fas fa-eye show-password"></i>
                                    <i class="fas fa-eye-slash hide-password"></i>
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password-field">
                                </div>

                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Change Password</button>

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
