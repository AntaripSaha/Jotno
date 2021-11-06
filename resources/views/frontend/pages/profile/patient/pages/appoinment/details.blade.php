@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">
<style>
    .paginate-row {
        padding-left: 15px;
    }

    .card-table .card-body {
        padding: 15px;
    }

    .addDiv {
        margin-top: 4px;
        padding: 0px;
        border-radius: 2px;
    }

    .addDivLeft {
        margin: 0px;
        padding: 0px;
    }

    .contact .info-box {
        border-top: 4px solid #6d1a0c;
        padding: 0px;
    }

    .formGroupRightPadding {
        padding: 2px;
    }

    .smallDiv-6 {
        margin: 0px;
        padding: 0px;
    }

    .section-title {
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
    }

    .theiaStickySidebar .widget-profile .rightSideSection {
        padding: 0px;
        margin: 0px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        color: #0168b3 !important;
    }

    .medicine-box {
        padding: 15px;
        border: 1px solid #0168b3;
        border-left: 5px solid red;
        margin-bottom: 15px;
    }

    .right-part {
        padding: 0 30px;
    }

    .add-more-row .col-md-3 {
        padding-left: 0;
        margin-bottom: 15px;
    }

    .add-more-row .col-md-3 button {
        background: #0168b3;
        color: white;
        border: none;
        padding: 7px 20px;
    }

    .or-row {
        display: none;
    }

    .drop-row {
        display: none;
    }

    .tab-pane ul li {
        list-style: none;
    }

    .tab-pane ul {
        margin-top: 15px;
    }

    .tab-pane.doctor ul li {
        display: -webkit-box;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #ee344e;
    }

</style>
@endsection

@section('body-content')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<div class="content" style="transform: none">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <!-- left part start -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px; margin:0px; padding:0px;">

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 0px;">
                    @include("frontend.pages.profile.patient.includes.left_sidebar")
                </div>
            </div>
            <!-- left part end -->


            <!-- right part start -->
            <div class="col-md-7 col-lg-8 col-xl-9 rightSideSection">

                <div class="row">

                    <div class="col-md-12">
                        <h4 class="mb-4">
                            Patient Appoinment No : {{ $appoinment->appoinment_no }}
                        </h4>
                    </div>

                    <div class="col-md-12">

                        <div class="appointment-tab">

                            @include("frontend.pages.profile.patient.pages.appoinment.includes.topbar")

                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-12 col-12">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab"
                                                        role="tablist" aria-orientation="vertical"
                                                        style="display: -webkit-box;">

                                                        <a class="nav-link active" id="v-pills-home-tab"
                                                            data-toggle="pill" href="#tab-one" role="tab"
                                                            aria-controls="v-pills-home" aria-selected="true">
                                                            Appoinment Details
                                                        </a>

                                                        @if( $appoinment->doctor_id )
                                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                                                            href="#tab-two" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">
                                                            Doctor Information
                                                        </a>
                                                        @endif

                                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                                                            href="#tab-three" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">
                                                            Initial Tests
                                                        </a>

                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">
                                                    <div class="tab-content " id="v-pills-tabContent">

                                                        <!-- item start -->
                                                        <div class="tab-pane fade show active row" id="tab-one"
                                                            role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="col-md-12">
                                                                <ul>
                                                                    <li>
                                                                        Appoinment Date :
                                                                        {{ $appoinment->appoinment_date }}
                                                                    </li>
                                                                    <li>
                                                                        Total :
                                                                        {{ $appoinment->total ? $appoinment->total : 'N/A' }}
                                                                    </li>
                                                                    <li>
                                                                        Appoinment Status : {{ $appoinment->status }}
                                                                    </li>
                                                                    <li>
                                                                        Payment Status : {{ $appoinment->payment_status }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- item end -->

                                                        <!-- item start -->
                                                        @if( $appoinment->doctor_id )
                                                        <div class="tab-pane doctor fade show row" id="tab-two"
                                                            role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <div class="doctor-widget">
                                                                        <div class="doc-info-left">
                                                                            <div class="doctor-img">
                                                                                @if( $appoinment->doctor->image )
                                                                                <img src="{{ asset('images/profile/doctor/'.$appoinment->doctor->image) }}"
                                                                                    alt="">
                                                                                @else
                                                                                <img src="{{ asset('images/profile/user.png') }}"
                                                                                    alt="">
                                                                                @endif
                                                                            </div>
                                                                            <div class="doc-info-cont">
                                                                                <h4 class="doc-name">
                                                                                    {{ $appoinment->doctor->name }} ( {{ $appoinment->doctor->charge->type }} )
                                                                                </h4>
                                                                                <p class="doc-speciality">
                                                                                    {{ $appoinment->doctor->doctor_id }}
                                                                                </p>
                                                                                <p class="doc-speciality">
                                                                                    {{ $appoinment->doctor->designation }}
                                                                                </p>


                                                                                <div class="clinic-details">
                                                                                    <p class="doc-location">
                                                                                        <i class="fas fa-hospital"></i>
                                                                                        {{ $appoinment->doctor->chamber }}
                                                                                    </p>
                                                                                    <p class="doc-location"><i
                                                                                            class="fas fa-map-marker-alt"></i>
                                                                                        {{ $appoinment->doctor->location }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="clinic-services">
                                                                                    <span>
                                                                                        In :
                                                                                        {{ $appoinment->doctor->in }}
                                                                                    </span>
                                                                                    <span>
                                                                                        Out :
                                                                                        {{ $appoinment->doctor->out }}
                                                                                    </span>
                                                                                    @foreach( $appoinment->doctor->day
                                                                                    as $day )
                                                                                    <span>
                                                                                        {{ $day->day->name }}
                                                                                    </span>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="doc-info-right">
                                                                            <div class="clini-infos">
                                                                                <ul>
                                                                                    <li>
                                                                                        <i class="fas fa-envelope"></i>
                                                                                        {{ $appoinment->doctor->email }}
                                                                                    </li>
                                                                                    <li>
                                                                                        <i class="fas fa-phone"></i>
                                                                                        {{ $appoinment->doctor->phone }}
                                                                                    </li>
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <!-- item end -->

                                                        <!-- item start -->
                                                        <div class="tab-pane fade show row" id="tab-three"
                                                            role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="col-md-12">
                                                                <ul>
                                                                    @foreach( $appoinment->initial_test as $initial_test
                                                                    )
                                                                    <li>
                                                                        {{ $initial_test->initial_test->name }} :
                                                                        {{ $initial_test->value }}
                                                                    </li>
                                                                    @endforeach
                                                                    @if( $initial_test_timing )
                                                                    <li style="margin-top : 15px">
                                                                        <i class="fas fa-clock"></i>
                                                                        {{ $initial_test_timing->created_at->toDayDateTimeString() }}
                                                                    </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- item end -->

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- TAB ITEM END -->

                                </div>
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






@endsection
