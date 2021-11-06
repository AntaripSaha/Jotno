@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
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

</style>
<link rel="stylesheet" href="{{ asset('frontend/css/prescription.css') }}">
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
                                        <div class="card-body prescription-topbar">
                                            <div class="col-md-12">
                                                <ul>
                                                    <li>
                                                        <a href="#" onclick="window.print()">
                                                            <i class="fas fa-print"></i>
                                                            Print
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" id="downloadPDF">
                                                            <i class="fas fa-file-pdf"></i>
                                                            Download PDF
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('patient.perscription.billing',$prescription->prescription_no) }}">
                                                            <i class="fas fa-file-invoice"></i>
                                                            Billing
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('patient.perscription.report.add.form',$prescription->prescription_no) }}">
                                                            <i class="fa fa-plus-circle"></i>
                                                            Add Report
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            href="{{ route('patient.perscription.report.view',['prescription_id'=>$prescription->id , 'appoinment_id' =>$appoinment->appoinment_no]) }}">
                                                            <i class="fa fa-eye"></i>
                                                            View Report
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body prescription-view-card pdf" id="prescription-view-card">

                                            <!-- doctor information row start -->
                                            <div class="col-md-12 doctor-information">
                                                <div class="row">

                                                    <!-- left part start -->
                                                    <div class="col-md-6 col-6">
                                                        <div class="left-card">
                                                            <p>
                                                                <b>
                                                                    {{ $appoinment->doctor->name }}
                                                                    ( {{ $appoinment->doctor->charge->type }} )
                                                                </b>
                                                            </p>
                                                            <div class="designation">
                                                                {!! $appoinment->doctor->designation !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- left part end -->

                                                    <!-- right part start -->
                                                    <div class="col-md-6 col-6">
                                                        <div class="right-card">
                                                            <p>Chamber</p>
                                                            <p>
                                                                {{ $appoinment->doctor->chamber }}
                                                            </p>
                                                            <p>
                                                                {{ $appoinment->doctor->location }}
                                                            </p>
                                                            <p>
                                                                Time :
                                                                @foreach( $appoinment->doctor->day as $day )
                                                                {{ substr($day->day->name,0,3) }}
                                                                @if( !$loop->last )
                                                                ,
                                                                @endif
                                                                @endforeach
                                                                {{ $appoinment->doctor->in }} to
                                                                {{ $appoinment->doctor->out }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- right part end -->

                                                </div>
                                            </div>
                                            <!-- doctor information row end -->

                                            <!-- patient information start -->
                                            <div class="col-md-12 patient-information">
                                                <div class="row">

                                                    <!-- item start -->
                                                    <div class="col-md-2 col-3 text-left">
                                                        <p>ID: {{ $appoinment->patient->patient_id }}</p>
                                                    </div>
                                                    <!-- item end -->

                                                    <!-- item start -->
                                                    <div class="col-md-4 col-3 text-left">
                                                        <p>Name: {{ $appoinment->patient->name }}</p>
                                                    </div>
                                                    <!-- item end -->

                                                    <!-- item start -->
                                                    <div class="col-md-3 col-3 text-left">
                                                        @php
                                                        $birthday = $appoinment->patient->date_of_birth;
                                                        $age =
                                                        Carbon\Carbon::parse($birthday)->diff(Carbon\Carbon::now())->format('%y
                                                        years');
                                                        @endphp
                                                        <p>Age: {{ $age }}</p>
                                                    </div>
                                                    <!-- item end -->

                                                    <!-- item start -->
                                                    <div class="col-md-3 col-3 text-left">
                                                        <p>Gender: {{ $appoinment->patient->gender }}</p>
                                                    </div>
                                                    <!-- item end -->

                                                    <!-- item start -->
                                                    @foreach( $appoinment->initial_test as $initial_test )
                                                    <div class="col-md-3 col-3 text-left">
                                                        <p>{{ $initial_test->initial_test->name }}:
                                                            {{ $initial_test->value }}</p>
                                                    </div>
                                                    @endforeach
                                                    <!-- item end -->

                                                </div>
                                            </div>
                                            <!-- patient information end -->

                                            <!-- prescription part start -->
                                            <div class="col-md-12 prescription-information">
                                                <div class="row">

                                                    <!-- left card start -->
                                                    <div class="col-md-5 col-5">
                                                        <div class="left-card">

                                                            <!-- chief complaint -->
                                                            <ul class="test-type">
                                                                <li>Chief Complaint</li>
                                                                <ul class="test-type-list">
                                                                    @foreach($prescription->chief_complaint as $chief_complaint )
                                                                    <li>
                                                                        {{ $chief_complaint->chief_complaint->name }}
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </ul>

                                                            @foreach( $prescription->prescription_test as
                                                            $prescription_test )
                                                            <ul class="test-type">
                                                                <li>{{ $prescription_test->test_type->name }}</li>
                                                                <ul class="test-type-list">
                                                                    @foreach(
                                                                    unserialize($prescription_test->test_type_list) as
                                                                    $test_type_list )
                                                                    <li>
                                                                        {{ App\Models\TestModule\TestTypeList::where("id",$test_type_list)->first()->name }}
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </ul>
                                                            @endforeach

                                                            <div class="advice">
                                                                <p>
                                                                    <b>Advice:</b>
                                                                </p>
                                                                {{ $prescription->advice }}
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- left card end -->

                                                    <!-- right card start -->
                                                    <div class="col-md-7 col-7">
                                                        <div class="right-card">

                                                            <!-- image card start -->
                                                            <div class="image">
                                                                <img src="{{ asset('frontend/img/rx.png') }}">
                                                            </div>
                                                            <!-- image card end -->

                                                            <!-- medicine card start -->
                                                            @foreach( $prescription->prescription_medicine as
                                                            $prescription_medicine )
                                                            <div class="medicine">
                                                                <h2>
                                                                    {{ $prescription_medicine->medicine->name }}
                                                                </h2>

                                                                @if( $prescription_medicine->type == "OR" )

                                                                <p>
                                                                    {{ $prescription_medicine->note }}
                                                                </p>

                                                                @else

                                                                @foreach( unserialize($prescription_medicine->timing)[0]
                                                                as $timing )
                                                                <span>
                                                                    {{ $timing['value'] }} :
                                                                    {{ App\Models\AppoinmentModule\Timing::where("id",$timing['id'])->select("value")->first()->value }}
                                                                    @if( !$loop->last )
                                                                    ,
                                                                    @endif
                                                                </span>
                                                                @endforeach

                                                                @endif

                                                            </div>
                                                            @endforeach
                                                            <!-- medicine card end -->

                                                        </div>
                                                    </div>
                                                    <!-- right card end -->

                                                </div>
                                            </div>
                                            <!-- prescription part end -->

                                            <!-- footer start -->
                                            <div class="col-md-12 footer-information">
                                                <p class="text-center">
                                                    {{ $appoinment->doctor->chamber }},
                                                    {{ $appoinment->doctor->location }}
                                                </p>
                                            </div>
                                            <!-- footer end -->

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

<!-- print start -->
<div class="card-body row prescription-view-card print">

    <!-- doctor information row start -->
    <div class="col-md-12 doctor-information">
        <div class="row">

            <!-- left part start -->
            <div class="col-md-6">
                <div class="left-card">
                    <p>
                    <b>
                                                                    {{ $appoinment->doctor->name }}
                                                                    ( {{ $appoinment->doctor->charge->type }} )
                                                                </b>
                    </p>
                    <div class="designation">
                        {!! $appoinment->doctor->designation !!}
                    </div>
                </div>
            </div>
            <!-- left part end -->

            <!-- right part start -->
            <div class="col-md-6">
                <div class="right-card">
                    <p>Chamber</p>
                    <p>
                        {{ $appoinment->doctor->chamber }}
                    </p>
                    <p>
                        {{ $appoinment->doctor->location }}
                    </p>
                    <p>
                        Time :
                        @foreach( $appoinment->doctor->day as $day )
                        {{ substr($day->day->name,0,3) }}
                        @if( !$loop->last )
                        ,
                        @endif
                        @endforeach
                        {{ $appoinment->doctor->in }} to {{ $appoinment->doctor->out }}
                    </p>
                </div>
            </div>
            <!-- right part end -->

        </div>
    </div>
    <!-- doctor information row end -->

    <!-- patient information start -->
    <div class="col-md-12 patient-information">
        <div class="row">

            <!-- item start -->
            <div class="col-md-2">
                <p>ID: {{ $appoinment->patient->patient_id }}</p>
            </div>
            <!-- item end -->

            <!-- item start -->
            <div class="col-md-4">
                <p>Name: {{ $appoinment->patient->name }}</p>
            </div>
            <!-- item end -->

            <!-- item start -->
            <div class="col-md-3">
                @php
                $birthday = $appoinment->patient->date_of_birth;
                $age = Carbon\Carbon::parse($birthday)->diff(Carbon\Carbon::now())->format('%y years');
                @endphp
                <p>Age: {{ $age }}</p>
            </div>
            <!-- item end -->

            <!-- item start -->
            <div class="col-md-3 col-3">
                <p>Gender: {{ $appoinment->patient->gender }}</p>
            </div>
            <!-- item end -->

            <!-- item start -->
            @foreach( $appoinment->initial_test as $initial_test )
            <div class="col-md-2 col-3">
                <p>{{ $initial_test->initial_test->name }}: {{ $initial_test->value }}</p>
            </div>
            @endforeach
            <!-- item end -->

        </div>
    </div>
    <!-- patient information end -->

    <!-- prescription part start -->
    <div class="col-md-12 prescription-information">
        <div class="row">

            <!-- left card start -->
            <div class="col-md-5">
                <div class="left-card">

                                                                        
                    <!-- chief complaint -->
                    <ul class="test-type">
                        <li>Chief Complaint</li>
                        <ul class="test-type-list">
                            @foreach($prescription->chief_complaint as $chief_complaint )
                            <li>
                                {{ $chief_complaint->chief_complaint->name }}
                            </li>
                            @endforeach
                        </ul>
                    </ul>
                    
                    @foreach( $prescription->prescription_test as $prescription_test )
                    <ul class="test-type">
                        <li>{{ $prescription_test->test_type->name }}</li>
                        <ul class="test-type-list">
                            @foreach( unserialize($prescription_test->test_type_list) as $test_type_list )
                            <li>
                                {{ App\Models\TestModule\TestTypeList::where("id",$test_type_list)->first()->name }}
                            </li>
                            @endforeach
                        </ul>
                    </ul>
                    @endforeach

                    <div class="advice">
                        <p>
                            <b>Advice:</b>
                        </p>
                        {{ $prescription->advice }}
                    </div>

                </div>
            </div>
            <!-- left card end -->

            <!-- right card start -->
            <div class="col-md-7">
                <div class="right-card">

                    <!-- image card start -->
                    <div class="image">
                        <img src="{{ asset('frontend/img/rx.png') }}">
                    </div>
                    <!-- image card end -->

                    <!-- medicine card start -->
                    @foreach( $prescription->prescription_medicine as $prescription_medicine )
                    <div class="medicine">
                        <h2>
                            {{ $prescription_medicine->medicine->name }}
                        </h2>

                        @if( $prescription_medicine->type == "OR" )

                        <p>
                            {{ $prescription_medicine->note }}
                        </p>

                        @else

                        @foreach( unserialize($prescription_medicine->timing)[0] as $timing )
                        <span>
                            {{ $timing['value'] }} :
                            {{ App\Models\AppoinmentModule\Timing::where("id",$timing['id'])->select("value")->first()->value }}
                            @if( !$loop->last )
                            ,
                            @endif
                        </span>
                        @endforeach

                        @endif

                    </div>
                    @endforeach
                    <!-- medicine card end -->

                </div>
            </div>
            <!-- right card end -->

        </div>
    </div>
    <!-- prescription part end -->

    <!-- footer start -->
    <div class="col-md-12 footer-information">
        <p class="text-center">
            {{ $appoinment->doctor->chamber }}, {{ $appoinment->doctor->location }}
        </p>
    </div>
    <!-- footer end -->

</div>
<!-- print end -->

@section('per_page_js')
<script src="{{ asset('frontend/js/html2pdf.js') }}"></script>
<script>
    document.getElementById("downloadPDF").addEventListener("click", function () {
        const invoice = document.getElementById("prescription-view-card")
        var opt = {
            margin: 0,
            filename: 'prescription_{{ $prescription->prescription_no }}.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 1
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        }
        html2pdf().from(invoice).set(opt).save()
    })

</script>
@endsection
