@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/css/rich_text_editor/rte_theme_default.css') }}">

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
    .rte-modern.rte-desktop.rte-toolbar-default {
        min-width: 100%!important;
    }

</style>
@endsection

@section('body-content')
<div class="loading">Loading&#8230;</div>
<div class="content" style="transform: none; min-height: 201px;">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <!-- LEFT SIDEBAR START -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">

                    @include('frontend.pages.profile.doctor.includes.left_sidebar')

                </div>
            </div>
            <!-- LEFT SIDEBAR END -->

            <!-- RIGHT SIDEBAR START -->
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
                                            <form action="{{ route('doctor.update.profile.setting') }}" method="post"
                                                class="ajax-form" enctype="multipart/form-data">
                                                @csrf

                                                <div class="row">

                                                    <!-- name -->
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ auth('doctor')->user()->name }}">
                                                    </div>

                                                    <!-- email -->
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{ auth('doctor')->user()->email }}">
                                                    </div>

                                                    <!-- phone -->
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ auth('doctor')->user()->phone }}">
                                                    </div>

                                                    <!-- designation -->
                                                    <div class="col-md-12 col-12 form-group">
                                                        <label>Designation</label>
                                                        <textarea class="form-control" name="designation">
                                                        {!! auth('doctor')->user()->designation !!}
                                                        </textarea>
                                                    </div>

                                                    <!-- Degree -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label >Degree</label>
                                                        <input type="text" class="form-control" name="degree" value="{{ auth('doctor')->user()->degree }}">
                                                    </div>

                                                    <!-- Any Speciality ( Optional ) -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label >Any Speciality ( Optional )</label>
                                                        <input type="text" class="form-control" name="speciality" value="{{ auth('doctor')->user()->speciality }}">
                                                    </div>

                                                    <!-- Nid Card ( Optional ) -->
                                                    <div class="col-md-12 col-12 form-group">
                                                        <label >Nid Card ( Optional )</label>
                                                        <input type="number" class="form-control" name="nid" value="{{ auth('doctor')->user()->nid }}">
                                                    </div>

                                                    <!-- chamber -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>Chamber</label>
                                                        <input type="text" class="form-control" name="chamber" value="{{ auth('doctor')->user()->chamber }}">
                                                    </div>

                                                    <!-- chamber location -->
                                                    <div class="col-md-6 col-12 form-group">
                                                        <label>Chamber Location</label>
                                                        <input type="text" class="form-control" name="location" value="{{ auth('doctor')->user()->location }}">
                                                    </div>

                                                    <!-- gender -->
                                                    <div class="col-12 col-md-4 form-group">
                                                        <label>Gender</label>
                                                        <select class="form-control select" name="gender">
                                                            <option value="Male" @if( auth('doctor')->user()->gender
                                                                == "Male" ) selected @endif >Male</option>
                                                            <option value="Female" @if( auth('doctor')->user()->gender
                                                                == "Female" ) selected @endif >Female</option>
                                                        </select>
                                                    </div>

                                                    <!-- in time -->
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label>In time</label>
                                                        <input type="time" class="form-control" name="in"
                                                            value="{{ auth('doctor')->user()->in }}">
                                                    </div>

                                                    <!-- out time -->
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label>Out time</label>
                                                        <input type="time" class="form-control" name="out"
                                                            value="{{ auth('doctor')->user()->out }}">
                                                    </div>

                                                     <!-- day -->
                                                     <div class="col-md-12 col-12 form-group">
                                                        <label>Days</label>
                                                        <select class="form-control select2" multiple name="day_id[]">
                                                            @foreach( $selected_days as $day )
                                                            <option value="{{ $day->id }}" selected >{{ $day->name }}</option>
                                                            @endforeach
                                                            @foreach( $days as $day )
                                                            <option value="{{ $day->id }}" >{{ $day->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-check form-group col-md-12" style="margin-left: 15px;">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="is_available" name="is_available" value="1"
                                                            @if( auth('doctor')->user()->is_available == true ) checked @endif
                                                            
                                                            >
                                                        <label class="form-check-label" for="is_available">
                                                            I'm Availabe 
                                                        </label>
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
            <!-- RIGHT SIDEBAR END -->

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

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function domReady() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#myModal')
        });
    });
</script>


<script src="{{ asset('backend/js/rich_text_editor/all_pluggins.js') }}"></script>
<script src="{{ asset('backend/js/rich_text_editor/rte.js') }}"></script>
<script>
    var editor1 = new RichTextEditor(".div_editor1");
    var editor2 = new RichTextEditor(".div_editor2");
</script>
@endsection
