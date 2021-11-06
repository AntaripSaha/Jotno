@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">

<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

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

    .add-initial-test {
        text-align: right;
        margin-top: 15px;
    }

    .add-initial-test a {
        display: initial;
        color: white;
    }

    .item-row {
        margin-bottom: 30px;
    }

    .select2-container {
        z-index: 9999 !important;
    }

    .tab-pane ul li {
        list-style: none;
    }

    .select2-container--default .select2-selection--single {
        min-height: 46px;
        padding-top: 8px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 10px;
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
                    @include("frontend.pages.profile.medical_assistant.includes.left_sidebar")
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
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

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

                    <div class="col-md-12">

                        <div class="appointment-tab">

                            @include("frontend.pages.profile.medical_assistant.pages.appoinment.includes.topbar")

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

                                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                                                            href="#tab-two" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">
                                                            Appoinment Note
                                                        </a>

                                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                                                            href="#tab-three" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">
                                                            Patient Detail
                                                        </a>

                                                        @if( $appoinment->doctor_id )
                                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                                                            href="#tab-four" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">
                                                            Doctor Information
                                                        </a>
                                                        @endif

                                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                                                            href="#tab-five" role="tab" aria-controls="v-pills-home"
                                                            aria-selected="true">
                                                            Initial Tests
                                                        </a>

                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-12">

                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        <div class="row add-initial-test">
                                                            <div class="col-md-12">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-primary"
                                                                    data-toggle="modal" data-target="#exampleModal">
                                                                    Add
                                                                </button>


                                                            </div>
                                                        </div>
                                                    </div>

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
                                                        <div class="tab-pane fade show row" id="tab-two" role="tabpanel"
                                                            aria-labelledby="v-pills-home-tab">
                                                            <div class="col-md-12">
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
                                                        <div class="tab-pane fade show row" id="tab-three"
                                                            role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <div class="doctor-widget">
                                                                        <div class="doc-info-left">
                                                                            <div class="doctor-img">
                                                                                @if( $patient->image )
                                                                                <img src="{{ asset('images/profile/patient/'.$patient->image) }}" alt="">
                                                                                @else
                                                                                <img src="{{ asset('images/profile/user.png') }}" alt="">
                                                                                @endif
                                                                            </div>
                                                                            <div class="doc-info-cont">
                                                                                <h4 class="doc-name">{{ $patient->name }}
                                                                                </h4>
                                                                                <p class="doc-speciality">{{ $patient->patient_id }}</p>
                                                                                
                                                                                
                                                                                <div class="clinic-details">
                                                                                    <p class="doc-location"><i
                                                                                            class="fas fa-map-marker-alt"></i>
                                                                                            {{ $patient->address }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="clinic-services">
                                                                                    <span>
                                                                                        DOB : {{ $patient->date_of_birth }}
                                                                                    </span>
                                                                                    <span>
                                                                                        Blood Group : {{ $patient->blood_group }}
                                                                                    </span>
                                                                                    <span>
                                                                                        Gender : {{ $patient->gender }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="doc-info-right">
                                                                            <div class="clini-infos">
                                                                                <ul>
                                                                                    <li>
                                                                                        <i class="fas fa-envelope"></i>
                                                                                        {{ $patient->email }}
                                                                                    </li>
                                                                                    <li>
                                                                                        <i class="fas fa-phone"></i>
                                                                                        {{ $patient->phone }}
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- item end -->

                                                        <!-- item start -->
                                                        @if( $appoinment->doctor_id )
                                                        <div class="tab-pane doctor fade show row" id="tab-four"
                                                            role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <div class="doctor-widget">
                                                                        <div class="doc-info-left">
                                                                            <div class="doctor-img">
                                                                                @if( $appoinment->doctor->image )
                                                                                <img src="{{ asset('images/profile/doctor/'.$appoinment->doctor->image) }}" alt="">
                                                                                @else
                                                                                <img src="{{ asset('images/profile/user.png') }}" alt="">
                                                                                @endif
                                                                            </div>
                                                                            <div class="doc-info-cont">
                                                                                <h4 class="doc-name">{{ $appoinment->doctor->name }} ( {{ $appoinment->doctor->charge->type }} )
                                                                                </h4>
                                                                                <p class="doc-speciality">{{ $appoinment->doctor->doctor_id }}</p>
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
                                                                                        In : {{ $appoinment->doctor->in }}
                                                                                    </span>
                                                                                    <span>
                                                                                        Out : {{ $appoinment->doctor->out }}
                                                                                    </span>
                                                                                    @foreach( $appoinment->doctor->day as $day )
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
                                                        <div class="tab-pane fade show row" id="tab-five"
                                                            role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="col-md-12 table-responsive"
                                                                style="margin-top: 15px">
                                                                <table
                                                                    class="table table-hover table-center mb-0 initial-test-datatable"
                                                                    id="datatable" style="width: 100%;">
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add initial Test
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post"
                    action="{{ route('medical.assistant.appoinment.initial.test',$appoinment->appoinment_no) }}">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 col-12 form-group">
                            <label>Assign Doctor</label>
                            <select class="form-control select2" name="doctor_id" required>
                                @foreach( $assign_doctor as $doctor )
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->name }}( {{ $doctor->charge->type }} )
                                </option>
                                @endforeach
                                @foreach( $doctors as $doctor )
                                @foreach( $doctor->day as $day )
                                @if( $day->day->name == \Carbon\Carbon::now()->format('l') )
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->name }}(  {{ $doctor->charge->type }}  )
                                </option>
                                @endif
                                @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="assign_doctor"
                                    name="assign_doctor">
                                <label class="form-check-label" for="assign_doctor">
                                    Assign Doctor Only
                                </label>
                            </div>
                        </div>


                        <div class="col-md-12 col-12 form-group initial-test-list initial_test">

                            <!-- item start -->
                            <div class="row item-row">

                                <div class="col-md-6 col-12">
                                    <label>Initial Test</label>
                                    <select class="form-control" name="initial_test_id[]">
                                        @foreach( $initial_tests as $initial_test )
                                        <option value="{{ $initial_test->id }}">{{ $initial_test->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label>Test Result</label>
                                    <input type="text" class="form-control" name="test_value[]">
                                </div>

                            </div>
                            <!-- item end -->

                        </div>

                        <div class="col-md-12 col-12 form-group initial_test">
                            <button type="button" class="btn btn-success add-more">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        
                        <div class="col-md-12 form-group text-right">
                            <button type="submit" class="btn btn-outline-dark">
                                Add
                            </button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('per_page_js')
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>
<script src="{{ asset('frontend/js/modal.js') }}"></script>

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('backend/js/datatable/jquery.validate.js') }}"></script>
<script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $('.initial-test-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('medical.assistant.appoinment.initial.test.data',$appoinment->appoinment_no) }}",
            order: [
                [0, 'Desc']
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'test_name',
                    name: 'test_name'
                },
                {
                    data: 'value',
                    name: 'value'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    });

</script>

<script>
    function select2Refresh() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $('#exampleModal')
        });
    }
    select2Refresh()
</script>

<script>
    $(document).on("click", ".add-more", function () {

        setTimeout(function () {
            select2Refresh();
        }, 300);

        $(".initial-test-list").append(`
            <!-- item start -->
            <div class="row item-row">

                <div class="col-md-4 col-12">
                    <label>Initial Test</label>
                    <select class="form-control" name="initial_test_id[]">
                        @foreach( $initial_tests as $initial_test )
                        <option value="{{ $initial_test->id }}">{{ $initial_test->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 col-8">
                    <label>Test Result</label>
                    <input type="text" class="form-control" name="test_value[]">
                </div>

                <div class="col-md-1 col-2">
                    <button type="button" class="btn btn-danger remove-item" style="margin-top: 30px">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

            </div>
            <!-- item end -->
        `);
    });

    $(document).on("click", ".remove-item", function () {
        let $this = $(this)
        $this.closest(".item-row").remove()
    })

</script>


<script>
    $(document).on("click", "#assign_doctor", function (e) {
        if (e.target.checked == true) {
            $(".initial_test").hide()
        } else {
            $(".initial_test").show()
        }
    })

</script>
@endsection
