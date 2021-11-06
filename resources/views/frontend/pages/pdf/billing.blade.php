<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ public_path('frontend/css/bootstrap-3.css') }}">
    <link rel="stylesheet" href="{{ public_path('frontend/css/billing.css') }}">
    <style>
        .topbar-information,
        .invoice-to{
            display: block;
            width: 100%;
        }
        .topbar-information .col-md-3{
            width: 30%;
            float: left;
        }
        .invoice-to .col-md-8{
            width: 60%;
            float: left;
        }
        .invoice-to .col-md-4{
            width: 33%;
            float: left;
        }
        table,td, th {
            border: 1px solid black;
            border-collapse: collapse;
            width:100%;
        }
        .invoice-box .invoice-to .right table{
            border: none!important;
        }
        .invoice-box .invoice-to .right table thead tr th {
            border: none!important;
        }
        .payment-status-text{
            top: 10%!important;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body invoice-box">

            <p class="payment-status-text">
                {{ $prescription->appoinment->payment_status }}
            </p>

            <!-- information part start -->
            <div class="row topbar-information">

                <!-- left part start -->
                <div class="col-md-3 left">
                    <p>Prescription {{ $prescription->prescription_no }} </p>
                </div>
                <!-- left part end -->

                <!-- right part start -->
                <div class="col-md-8 right text-right">
                    <img src="{{ public_path('frontend/img/logo-4.png') }}" class="img-fluid" alt="Logo">
                    <p>{{ $prescription->appoinment->doctor->chamber }}</p>
                    <p>{{ $prescription->appoinment->doctor->location }}</p>
                </div>
                <!-- right part end -->

            </div>
            <!-- information part end -->

            <!-- invoice to part start -->
            <div class="row invoice-to">

                <!-- left part start -->
                <div class="col-md-8 left">
                    <h2>Prescription To</h2>
                    <p>{{ $prescription->appoinment->patient->name }}</p>
                    <p>{{ $prescription->appoinment->patient->address }}</p>
                    <p>Phone: {{ $prescription->appoinment->patient->phone }}</p>
                    <p>Email: {{ $prescription->appoinment->patient->email }}</p>
                </div>
                <!-- left part end -->

                <!-- right part start -->
                <div class="col-md-4 right ">
                    <table>
                        <thead>
                            <tr>
                                <th class="left" >Prescription</th>
                                <th class="right" >{{ $prescription->prescription_no }}</th>
                            </tr>
                            <tr>
                                <th class="left" >Status</th>
                                <th class="right" >{{ $prescription->appoinment->payment_status }}</th>
                            </tr>
                            <tr>
                                <th class="left" >Invoice Date</th>
                                <th class="right" >{{ $prescription->appoinment->appoinment_date }}</th>
                            </tr>
                            <tr>
                                <th class="left" >Amount</th>
                                <th class="right" >BDT {{ $prescription->appoinment->total }}</th>
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
                                <td colspan="2">Total</td>
                                <td>{{ $prescription->appoinment->total }}</td>
                            </tr>
                        </tfoot>
                        <tfoot>
                            <tr>
                                <td colspan="2">Charge</td>
                                <td>{{ $prescription->appoinment->doctor->charge->amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total</td>
                                <td>{{ $prescription->appoinment->total + $prescription->appoinment->doctor->charge->amount }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- invoice test with price end -->

        </div>
    </div>
</body>

</html>
