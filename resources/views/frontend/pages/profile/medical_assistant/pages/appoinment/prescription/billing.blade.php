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

    .card-body.invoice-box.print {
        display: none;
    }

    @media print {

        .main-wrapper,
        header {
            display: none;
        }

        .card-body.invoice-box.print {
            display: block;
        }
    }

</style>
<link rel="stylesheet" href="{{ asset('frontend/css/prescription.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/billing.css') }}">
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

                        <div class="appointment-tab">

                            @include("frontend.pages.profile.medical_assistant.pages.appoinment.includes.topbar")

                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body prescription-topbar">
                                            <div class="col-md-12">
                                                <ul>
                                                    <li>
                                                        <a
                                                            href="{{ route('medical.assistant.perscription.view',$prescription->prescription_no) }}">
                                                            <i class="fas fa-angle-left"></i>
                                                            Back
                                                        </a>
                                                    </li>
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
                                                        <select name="" class="payment-status">
                                                            <option value="">Payment Status</option>
                                                            <option value="Paid" @if( $prescription->appoinment->payment_status == "Paid" ) selected @endif >Paid</option>
                                                            <option value="Unpaid" @if( $prescription->appoinment->payment_status == "Unpaid" ) selected @endif >Unpaid</option>
                                                        </select>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body invoice-box table-responsive" id="bill-pdf">

                                            <p class="payment-status-text">
                                                {{ $prescription->appoinment->payment_status }}
                                            </p>

                                            <!-- information part start -->
                                            <div class="row topbar-information">

                                                <!-- left part start -->
                                                <div class="col-md-6 col-6 left">
                                                    <p>Prescription {{ $prescription->prescription_no }} </p>
                                                </div>
                                                <!-- left part end -->

                                                <!-- right part start -->
                                                <div class="col-md-6 col-6 right text-right">
                                                    <img src="{{ asset('frontend/img/logo-4.png') }}" class="img-fluid"
                                                        alt="Logo">
                                                    <p>{{ $appoinment->doctor->chamber }}</p>
                                                    <p>{{ $appoinment->doctor->location }}</p>
                                                </div>
                                                <!-- right part end -->

                                            </div>
                                            <!-- information part end -->

                                            <!-- invoice to part start -->
                                            <div class="row invoice-to">

                                                <!-- left part start -->
                                                <div class="col-md-8 col-8 left">
                                                    <h2>Prescription To</h2>
                                                    <p>{{ $appoinment->patient->name }}</p>
                                                    <p>{{ $appoinment->patient->address }}</p>
                                                    <p>Phone: {{ $appoinment->patient->phone }}</p>
                                                    <p>Email: {{ $appoinment->patient->email }}</p>
                                                </div>
                                                <!-- left part end -->

                                                <!-- right part start -->
                                                <div class="col-md-4 col-4 right">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="left">Prescription</th>
                                                                <th class="right">{{ $prescription->prescription_no }}
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="left">Status</th>
                                                                <th class="right">{{ $appoinment->payment_status }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="left">Invoice Date</th>
                                                                <th class="right">{{ $appoinment->appoinment_date }}
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="left">Amount</th>
                                                                <th class="right">BDT {{ $prescription->appoinment->total }}</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <!-- right part end -->


                                            </div>
                                            <!-- invoice to part end -->

                                            <!-- invoice test with price start -->
                                            <div class="row invoice-test">
                                                <div class="col-md-12">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th>Test type</th>
                                                                <th>Test Name</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>

                                                        @foreach( $prescription->prescription_test as $prescription_test
                                                        )
                                                        @php
                                                        $count = 0;
                                                        $count = count(unserialize($prescription_test->test_type_list));
                                                        @endphp
                                                        <tbody>
                                                            <tr>
                                                                <td rowspan="{{ $count }}">
                                                                    {{ $prescription_test->test_type->name }}</td>
                                                                @foreach(
                                                                unserialize($prescription_test->test_type_list) as $key
                                                                => $test_type_list )
                                                                @if( $key == 0 )
                                                                @php
                                                                $result =
                                                                App\Models\TestModule\TestTypeList::where("id",$test_type_list)->first()
                                                                @endphp
                                                                <td>{{ $result->name }}</td>
                                                                <td>{{ $result->price }}</td>
                                                                @endif
                                                                @endforeach
                                                            </tr>
                                                            @foreach( unserialize($prescription_test->test_type_list) as
                                                            $key => $test_type_list )
                                                            @if( $key != 0 )
                                                            @php
                                                            $result =
                                                            App\Models\TestModule\TestTypeList::where("id",$test_type_list)->first()
                                                            @endphp
                                                            <tr rowspan="2">
                                                                <td>{{ $result->name }}</td>
                                                                <td>{{ $result->price }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                        @endforeach
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2">Charge</td>
                                                                <td>{{ $appoinment->doctor->charge->amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">Total</td>
                                                                <td>{{ $appoinment->total + $appoinment->doctor->charge->amount }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- invoice test with price end -->

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

<div class="card-body invoice-box print">

    <p class="payment-status-text">
        {{ $prescription->appoinment->payment_status }}
    </p>

    <!-- information part start -->
    <div class="row topbar-information">

        <!-- left part start -->
        <div class="col-md-6 col-6 left">
            <p>Prescription {{ $prescription->prescription_no }} </p>
        </div>
        <!-- left part end -->

        <!-- right part start -->
        <div class="col-md-6 col-6 right text-right">
            <img src="{{ asset('frontend/img/logo-4.png') }}" class="img-fluid" alt="Logo">
            <p>{{ $appoinment->doctor->chamber }}</p>
            <p>{{ $appoinment->doctor->location }}</p>
        </div>
        <!-- right part end -->

    </div>
    <!-- information part end -->

    <!-- invoice to part start -->
    <div class="row invoice-to">

        <!-- left part start -->
        <div class="col-md-8 left">
            <h2>Prescription To</h2>
            <p>{{ $appoinment->patient->name }}</p>
            <p>{{ $appoinment->patient->address }}</p>
            <p>Phone: {{ $appoinment->patient->phone }}</p>
            <p>Email: {{ $appoinment->patient->email }}</p>
        </div>
        <!-- left part end -->

        <!-- right part start -->
        <div class="col-md-4 right">
            <table>
                <thead>
                    <tr>
                        <th class="left">Prescription</th>
                        <th class="right">{{ $prescription->prescription_no }}</th>
                    </tr>
                    <tr>
                        <th class="left">Status</th>
                        <th class="right">{{ $appoinment->payment_status }}</th>
                    </tr>
                    <tr>
                        <th class="left">Invoice Date</th>
                        <th class="right">{{ $appoinment->appoinment_date }}</th>
                    </tr>
                    <tr>
                        <th class="left">Amount</th>
                        <th class="right">BDT {{ $prescription->appoinment->total }}</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- right part end -->


    </div>
    <!-- invoice to part end -->

    <!-- invoice test with price start -->
    <div class="row invoice-test">
        <div class="col-md-12">
            <table>
                <thead>
                    <tr>
                        <th>Test type</th>
                        <th>Test Name</th>
                        <th>Price</th>
                    </tr>
                </thead>

                @foreach( $prescription->prescription_test as $prescription_test )
                @php
                $count = 0;
                $count = count(unserialize($prescription_test->test_type_list));
                @endphp
                <tbody>
                    <tr>
                        <td rowspan="{{ $count }}"> {{ $prescription_test->test_type->name }}</td>
                        @foreach( unserialize($prescription_test->test_type_list) as $key => $test_type_list )
                        @if( $key == 0 )
                        @php
                        $result = App\Models\TestModule\TestTypeList::where("id",$test_type_list)->first()
                        @endphp
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->price }}</td>
                        @endif
                        @endforeach
                    </tr>
                    @foreach( unserialize($prescription_test->test_type_list) as $key => $test_type_list )
                    @if( $key != 0 )
                    @php
                    $result = App\Models\TestModule\TestTypeList::where("id",$test_type_list)->first()
                    @endphp
                    <tr rowspan="2">
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->price }}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="2">Charge</td>
                        <td>{{ $appoinment->doctor->charge->amount }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Total</td>
                        <td>{{ $appoinment->total + $appoinment->doctor->charge->amount }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- invoice test with price end -->

</div>

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(".payment-status").change(function (e) {
        if (e.target.value) {
            $.ajax({
                "type": "GET",
                "url": "{{ route('medical.assistant.perscription.billing.change.status',$prescription->prescription_no) }}",
                "data": {
                    payment_status: e.target.value
                },
                success: function (response) {
                    if (response.success) {
                        swal("", `${response.success}`, "success")
                        $(".payment-status-text").html(response.msg)
                    }

                    if (response.error) {
                        swal("", `${response.error}`, "error")
                    }
                },
                error: function (response) {

                },
            })
        } else {
            swal("", "Please select a payment status", "warning")
        }
    })

</script>

<script src="{{ asset('frontend/js/html2pdf.js') }}"></script>
<script>
    document.getElementById("downloadPDF").addEventListener("click", function () {
        const invoice = document.getElementById("bill-pdf")
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
