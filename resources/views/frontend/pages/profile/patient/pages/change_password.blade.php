@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<style>
    .paginate-row {
        padding-left: 15px;
    }

    .card-body form {
        padding: 30px 15px !important;
    }

    #image-preview {
        padding: 0 0 15px 0;
        display: block;
        border-radius: 100%;
        width: 50px;
    }

    .password-box {
        position: relative;
    }

    .password-box .hide-password {
        display: none;
    }

    .password-box .fas {
        position: absolute;
        top: 57%;
        right: 30px;
        z-index: 10;
        cursor: pointer;
    }

</style>
@endsection

@section('body-content')
<div class="loading">Loading&#8230;</div>
<div class="content" style="transform: none; min-height: 201px;">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <!-- left part start -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 30px;">
                    @include("frontend.pages.profile.patient.includes.left_sidebar")
                </div>
            </div>
            <!-- left part end -->


            <!-- right part start -->
            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-4">Change Password</h4>
                        <div class="appointment-tab">

                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <form action="{{ route('patient.change.password') }}" method="post"
                                                class="ajax-form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">

                                                    <!-- old password -->
                                                    <div class="col-md-6 col-12 form-group password-box">
                                                        <i class="fas fa-eye show-password"></i>
                                                        <i class="fas fa-eye-slash hide-password"></i>
                                                        <label>Old Password</label>
                                                        <input type="password" class="form-control" id="password-field" name="old_password">
                                                    </div>

                                                    <!-- new password -->
                                                    <div class="col-md-6 col-12 form-group password-box">
                                                        <i class="fas fa-eye show-password"></i>
                                                        <i class="fas fa-eye-slash hide-password"></i>
                                                        <label>New Password</label>
                                                        <input type="password" class="form-control" id="password-field" name="password">
                                                    </div>

                                                    <!-- confirm password -->
                                                    <div class="col-md-12 col-12 form-group password-box">
                                                        <i class="fas fa-eye show-password"></i>
                                                        <i class="fas fa-eye-slash hide-password"></i>
                                                        <label>Confirm Password</label>
                                                        <input type="password" class="form-control" id="password-field"
                                                            name="password_confirmation">
                                                    </div>

                                                    <!-- button -->
                                                    <div class="col-md-2 col-12 form-group">
                                                        <button class="btn btn-primary btn-block btn-lg login-btn"
                                                            type="submit">
                                                            Change
                                                        </button>
                                                    </div>

                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- TAB ITEM END -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right part end -->

        </div>
    </div>
</div>

@endsection


@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>


<script>
    
    $(".show-password").click(function(){
        let $this = $(this)
        $this.closest(".password-box").find("#password-field").attr("type","text")
        $this.closest(".password-box").find(".show-password").hide()
        $this.closest(".password-box").find(".hide-password").show()
    })
    
    $(".hide-password").click(function(){
        let $this = $(this)
        $this.closest(".password-box").find("#password-field").attr("type","password")
        $this.closest(".password-box").find(".show-password").show()
        $this.closest(".password-box").find(".hide-password").hide()
    })
    
</script>
@endsection
