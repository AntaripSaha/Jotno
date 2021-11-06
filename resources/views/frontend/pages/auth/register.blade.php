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
                                alt="Doccure Register">
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>
                                    Registration<a class="forgot-link" href="{{ route('login') }}">Already have an
                                        account?</a>
                                </h3>
                            </div>
                            <form class="ajax-form" action="{{ route('do.register') }}" method="post">
                                @csrf
                                <div class="row form-row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" class="form-control datetimepicker" name="date_of_birth">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Blood Group</label>
                                            <select class="form-control select" name="blood_group">
                                                <option value="A-">A-</option>
                                                <option value="A+">A+</option>
                                                <option value="B-">B-</option>
                                                <option value="B+">B+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="O-">O-</option>
                                                <option value="O+">O+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control select" name="gender">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>District</label>
                                            <input type="text" class="form-control" name="district">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group password-box">
                                            <i class="fas fa-eye show-password"></i>
                                            <i class="fas fa-eye-slash hide-password"></i>
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password-field">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group password-box">
                                            <i class="fas fa-eye show-password"></i>
                                            <i class="fas fa-eye-slash hide-password"></i>
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password-field">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">
                                    Registration
                                </button>
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
