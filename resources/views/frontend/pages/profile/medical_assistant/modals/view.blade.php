<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $appoinment->appoinment_no }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="nav flex-column nav-pills col-md-3 col-12" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#tab-one" role="tab"
                aria-controls="v-pills-home" aria-selected="true">
                Appoinment Details
            </a>

            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-two" role="tab"
                aria-controls="v-pills-home" aria-selected="true">
                Appoinment Note
            </a>

            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-three" role="tab"
                aria-controls="v-pills-home" aria-selected="true">
                Patient Detail
            </a>

            @if( $appoinment->doctor_id )
            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-four" role="tab"
                aria-controls="v-pills-home" aria-selected="true">
                Doctor Information
            </a>
            @endif

            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#tab-five" role="tab"
                aria-controls="v-pills-home" aria-selected="true">
                Initial Tests
            </a>

        </div>
        <div class="tab-content col-md-9 col-12" id="v-pills-tabContent">

            <!-- item start -->
            <div class="tab-pane fade show active row" id="tab-one" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-md-12">
                    <ul>
                        <li>
                            Appoinment Date : {{ $appoinment->appoinment_date }}
                        </li>
                        <li>
                            Total :  {{ $appoinment->total ? $appoinment->total : 'N/A' }}
                        </li>
                        <li>
                            Appoinment Status : {{ $appoinment->status }}
                        </li>
                    </ul>
                </div>
            </div>
            <!-- item end -->

            <!-- item start -->
            <div class="tab-pane fade show row" id="tab-two" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-md-12">
                    <ul>
                        @foreach( $notes as $note )
                        <li>
                            {{ $note->note }}
                        </li>
                        <small>{{ $note->created_at->toDayDateTimeString() }} - </small>
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
            <div class="tab-pane fade show row" id="tab-three" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-md-12">
                    <ul>
                        <li>
                            
                            @if( $patient->image )
                            <img src="{{ asset('images/profile/patient/'.$patient->image) }}" width="50px" alt="">
                            @else
                            <img src="{{ asset('images/profile/user.png') }}" width="50px" alt="">
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
            <div class="tab-pane doctor fade show row" id="tab-four" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-md-12">
                    <ul>
                        <li>
                            
                            @if( $appoinment->doctor->image )
                            <img src="{{ asset('images/profile/doctor/'.$doctor->image) }}" width="50px" alt="">
                            @else
                            <img src="{{ asset('images/profile/user.png') }}" width="50px" alt="">
                            @endif
                        </li>
                        <li>
                            {{ $appoinment->doctor->doctor_id }}
                        </li>
                        <li>
                            {{ $appoinment->doctor->name }}
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
            <div class="tab-pane fade show row" id="tab-five" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="col-md-12">
                    <ul>
                        @foreach( $notes as $note )
                            @if( $note->initial_test_id )
                            <li>
                                @foreach( unserialize($note->initial_test_id) as $initial_test_id )
                                    {{ App\Models\TestModule\InitialTest::Where("id",$initial_test_id)->first()->name }},
                                @endforeach
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- item end -->

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
