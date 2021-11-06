@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
    .sub_module_block ul {
        padding-left: 15px !important;
    }

    .sub_module_block ul p {
        margin-bottom: 5px !important;
    }

    .select2-container {
        z-index: 99999 !important;
    }

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

    .prescription-view-card.print {
        display: none;
    }

    @media print {

        .main-wrapper,
        header {
            display: none;
        }

        .prescription-view-card.print {
            display: block;
        }
    }

    ul li {
        list-style: none;
    }

</style>
<link rel="stylesheet" href="{{ asset('frontend/css/prescription.css') }}">
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('appointment.all') }}">
                                All Appoinment
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 rightSideSection">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-body">
                            <!-- right part start -->

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <h4 class="mb-4">
                                        Patient Appoinment No : {{ $appoinment->appoinment_no }}
                                    </h4>
                                </div>
                                @if( $appoinment->status == "Pending" || $appoinment->status == "Confirm" )
                                <div class="col-md-6 col-12 text-right">
                                    <form
                                        action="{{ route('individual.appointment.cancel', $appoinment->appoinment_no) }}"
                                        method="post">
                                        @csrf
                                        <button class="btn btn-danger">
                                            Cancel Appoinment
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                            <!-- right part start -->
                            <div class="row">

                                <div class="col-md-12 col-12">
                                    @if( session()->has('success') )
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session()->get('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif

                                    @if( session()->has('error') )
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session()->get('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-md-3 col-12 clearfix">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">

                                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill"
                                            href="#tab-one" role="tab" aria-controls="v-pills-home"
                                            aria-selected="true">
                                            Appoinment Details
                                        </a>

                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-two"
                                            role="tab" aria-controls="v-pills-home" aria-selected="true">
                                            Appoinment Note
                                        </a>

                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-three"
                                            role="tab" aria-controls="v-pills-home" aria-selected="true">
                                            Patient Detail
                                        </a>

                                        @if( $appoinment->doctor_id )
                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-four"
                                            role="tab" aria-controls="v-pills-home" aria-selected="true">
                                            Doctor Information
                                        </a>
                                        @endif

                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-five"
                                            role="tab" aria-controls="v-pills-home" aria-selected="true">
                                            Initial Tests
                                        </a>

                                    </div>
                                </div>

                                <div class="col-md-9 col-12">

                                    <div class="tab-content " id="v-pills-tabContent">

                                        <!-- item start -->
                                        <div class="tab-pane fade show active row" id="tab-one" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="col-md-12 ml-2">
                                                <ul>
                                                    <li>
                                                        Appoinment Date :
                                                        {{ $appoinment->appoinment_date }}
                                                    </li>
                                                    <li>
                                                        Total Bill :
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
                                        <div class="tab-pane fade show row" id="tab-two" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="col-md-12 ml-2">
                                                <ul>
                                                    @foreach( $notes as $note )
                                                    <li>
                                                        {{ $note->note }}
                                                    </li>
                                                    <small>{{ $note->created_at->toDayDateTimeString() }}
                                                        - </small>
                                                    <small>
                                                        @if( $note->type == "MA" )
                                                        {{ $note->medical_assistant->name }}
                                                        @elseif( $note->type == "DOCTOR" )
                                                        {{ $note->doctor->name }}
                                                        @endif
                                                    </small>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- item end -->

                                        <!-- item start -->
                                        <div class="tab-pane fade show row" id="tab-three" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="col-md-12 ml-2">
                                                <ul>
                                                    <li>

                                                        @if( $patient->image )
                                                        <img src="{{ asset('images/profile/patient/'.$patient->image) }}"
                                                            width="50px" alt="">
                                                        @else
                                                        <img src="{{ asset('images/profile/user.png') }}" width="50px"
                                                            alt="">
                                                        @endif
                                                    </li>
                                                    <li>
                                                        Patient ID : {{ $patient->patient_id }}
                                                    </li>
                                                    <li>
                                                        Name : {{ $patient->name }}
                                                    </li>
                                                    <li>
                                                        Email : {{ $patient->email }}
                                                    </li>
                                                    <li>
                                                        Phone : {{ $patient->phone }}
                                                    </li>
                                                    <li>
                                                        DOB : {{ $patient->date_of_birth }}
                                                    </li>
                                                    <li>
                                                        Blood Group : {{ $patient->blood_group }}
                                                    </li>
                                                    <li>
                                                        Weight : {{ $patient->weight }}
                                                    </li>
                                                    <li>
                                                        Address : {{ $patient->address }}
                                                    </li>
                                                    <li>
                                                        City : {{ $patient->city }}
                                                    </li>
                                                    <li>
                                                        District : {{ $patient->district }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- item end -->

                                        <!-- item start -->
                                        @if( $appoinment->doctor_id )
                                        <div class="tab-pane doctor fade show row" id="tab-four" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="col-md-12 ml-2">
                                                <ul>
                                                    <li>

                                                        @if( $appoinment->doctor->image )
                                                        <img src="{{ asset('images/profile/doctor/'.$appoinment->doctor->image) }}"
                                                            width="50px" alt="">
                                                        @else
                                                        <img src="{{ asset('images/profile/user.png') }}" width="50px"
                                                            alt="">
                                                        @endif
                                                    </li>
                                                    <li>
                                                        {{ $appoinment->doctor->doctor_id }}
                                                    </li>
                                                    <li>
                                                        {{ $appoinment->doctor->name }} ( {{ $appoinment->doctor->charge->type }} )
                                                    </li>
                                                    <li>
                                                        {!! $appoinment->doctor->designation !!}
                                                    </li>
                                                    <li>
                                                        {{ $appoinment->doctor->email }}
                                                    </li>
                                                    <li>
                                                        {{ $appoinment->doctor->phone }}
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- item end -->

                                        <!-- item start -->
                                        <div class="tab-pane fade show row" id="tab-five" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="col-md-12 ml-2 table-responsive" style="margin-top: 15px">
                                                <table class="table table-hover table-center mb-0" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>SI</th>
                                                            <th>Test Name</th>
                                                            <th>Result</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- item end -->

                                    </div>
                                </div>

                            </div>
                            <!-- right part end -->
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('per_page_js')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>

@endsection
