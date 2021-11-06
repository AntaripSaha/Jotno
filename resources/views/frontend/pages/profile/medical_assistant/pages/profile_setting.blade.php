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
                    @include("frontend.pages.profile.medical_assistant.includes.left_sidebar")
                </div>
            </div>
            <!-- left part end -->


            <!-- right part start -->
            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-4">Update Profile Setting</h4>
                        <div class="appointment-tab">

                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <form action="{{ route('medical.assistant.update.profile.setting') }}"
                                                method="post" class="ajax-form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">

                                                    <!-- name -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ auth('medical_assistant')->user()->name }}">
                                                    </div>

                                                    <!-- email -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{ auth('medical_assistant')->user()->email }}">
                                                    </div>

                                                    <!-- phone -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ auth('medical_assistant')->user()->phone }}">
                                                    </div>

                                                    <!-- Present Address -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>Present Address</label>
                                                        <input type="text" class="form-control" name="present_address"
                                                            value="{{ auth('medical_assistant')->user()->present_address }}">
                                                    </div>

                                                    <!-- Permanent Address -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>Permanent Address</label>
                                                        <input type="text" class="form-control" name="permanent_address"
                                                            value="{{ auth('medical_assistant')->user()->permanent_address }}">
                                                    </div>

                                                    <!-- Nid -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>NID</label>
                                                        <input type="number" class="form-control" name="nid"
                                                            value="{{ auth('medical_assistant')->user()->nid }}">
                                                    </div>

                                                    <!-- BMDC Registration Number -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>BMDC Registration Number</label>
                                                        <input type="number" class="form-control" name="bmdc_reg_no"
                                                            value="{{ auth('medical_assistant')->user()->bmdc_reg_no }}">
                                                    </div>

                                                    <!-- image -->
                                                    <div class="col-md-12 col-12 form-group">
                                                        <label>Profile Image</label>
                                                        <img src="{{ asset('images/profile/user.png') }}"
                                                            id="image-preview">
                                                        <input type="file" name="image"
                                                            class="form-control-file gallery_image">
                                                    </div>

                                                    <!-- button -->
                                                    <div class="col-md-2 col-12 form-group">
                                                        <button class="btn btn-primary btn-block btn-lg login-btn"
                                                            type="submit">Save</button>
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
    $(document).on('change', '.gallery_image', function () {
        let $this = $(this)
        $this[0].previousElementSibling.setAttribute('src', URL.createObjectURL($this[0].files[0]))
    })

</script>
@endsection
