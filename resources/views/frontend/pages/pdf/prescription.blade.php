<!DOCTYPE html>
<html>

<head>
    {!! isset($pdf_style) ? $pdf_style : '' !!}
    <link rel="stylesheet" href="{{ public_path('frontend/css/bootstrap-3.css') }}">
    <link rel="stylesheet" href="{{ public_path('frontend/css/prescription.css') }}">

    <style>
        .prescription-information .row,
        .doctor-information .row{
            display: block;
            width: 100%;
        }
        .prescription-information .row .col-md-5{
            width: 40%;
            float: left;
        }
        .prescription-information .row .col-md-7{
            width: 60%;
            float: left;
            padding-right: 50px;
            border-left: 1px solid #efefef;
        }
        .doctor-information .row .col-md-3{
            width: 30%;
            float: left;
        }
        .doctor-information .row .col-md-7{
            width: 60%;
            float: left;
        }
        .patient-information .row{
            display: block;
            width: 100%;
        }
        .patient-information .row .col-md-3{
            display: flex;
            float: left;
            width: 20%;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="container prescription-view-card pdf" id="prescription-view-card">

            <!-- doctor information row start -->
            <div class="col-md-12 doctor-information">
                <div class="row">

                    <!-- left part start -->
                    <div class="col-md-3">
                        <div class="left-card">
                            <p>
                                <b>{{ $prescription->appoinment->doctor->name }} ( {{ $prescription->appoinment->doctor->charge->type }} )</b>
                            </p>
                            <div class="designation">
                                {!! $prescription->appoinment->doctor->designation !!}
                            </div>
                        </div>
                    </div>
                    <!-- left part end -->

                    <!-- right part start -->
                    <div class="col-md-7">
                        <div class="right-card">
                            <p>Chamber</p>
                            <p>
                                {{ $prescription->appoinment->doctor->chamber }}
                            </p>
                            <p>
                                {{ $prescription->appoinment->doctor->location }}
                            </p>
                            <p>
                                Time :
                                @foreach( $prescription->appoinment->doctor->day as $day )
                                {{ substr($day->day->name,0,3) }}
                                @if( !$loop->last )
                                ,
                                @endif
                                @endforeach
                                {{ $prescription->appoinment->doctor->in }} to
                                {{ $prescription->appoinment->doctor->out }}
                            </p>
                        </div>
                    </div>
                    <!-- right part end -->

                </div>
            </div>
            <!-- doctor information row end -->

            <!-- patient information start -->
            <div class="col-md-12 patient-information">
                <div class="row patient-info">

                    <!-- item start -->
                    <div class="col-md-3">
                        <p>ID: {{ $prescription->appoinment->patient->patient_id }}</p>
                    </div>
                    <!-- item end -->

                    <!-- item start -->
                    <div class="col-md-3">
                        <p>Name: {{ $prescription->appoinment->patient->name }}</p>
                    </div>
                    <!-- item end -->

                    <!-- item start -->
                    <div class="col-md-3">
                        @php
                        $birthday = $prescription->appoinment->patient->date_of_birth;
                        $age =
                        Carbon\Carbon::parse($birthday)->diff(Carbon\Carbon::now())->format('%y
                        years');
                        @endphp
                        <p>Age: {{ $age }}</p>
                    </div>
                    <!-- item end -->

                    <!-- item start -->
                    <div class="col-md-3">
                        <p>Gender: {{ $prescription->appoinment->patient->gender }}</p>
                    </div>
                    <!-- item end -->

                    <br><br>

                    @foreach( $prescription->appoinment->initial_test as $key => $initial_test )
                    <div class="col-md-3">
                        <p>
                        {{ $initial_test->initial_test->name }}
                        :
                        {{ $initial_test->value }}
                        </p>
                    </div>

                        @if( ( $key + 1 ) % 4 == 0 )
                        <br><br>
                        @endif
                    @endforeach
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
                    <div class="col-md-7">
                        <div class="right-card">

                            <!-- image card start -->
                            <div class="image">
                                <img src="{{ public_path('frontend/img/rx.png') }}">
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
                                    
                                    {{ App\Models\AppoinmentModule\Timing::where("id",$timing['id'])->select("value")->first()->value }}
                                    @if( !$loop->last )
                                    +
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
                    {{ $prescription->appoinment->doctor->chamber }},
                    {{ $prescription->appoinment->doctor->location }}
                </p>
            </div>
            <!-- footer end -->

        </div>
    </div>
</body>

</html>
