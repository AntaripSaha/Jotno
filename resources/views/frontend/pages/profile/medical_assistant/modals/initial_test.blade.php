<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ $appoinment->appoinment_no }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('medical.assistant.appoinment.note',$appoinment->id) }}">
        @csrf
        <div class="row">

            <div class="col-md-12 col-12 form-group">
                <label>Assign Doctor</label>
                <select class="form-control select2" name="doctor_id">
                    @foreach( $assign_doctor as $doctor )
                    <option value="{{ $doctor->id }}">
                        {{ $doctor->name }}( {{ $doctor->phone }} ) 
                    </option>
                    @endforeach
                    @foreach( $doctors as $doctor )
                        @foreach( $doctor->day as $day )
                            @if( $day->day->name == \Carbon\Carbon::now()->format('l') )
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->name }}( {{ $doctor->phone }} ) 
                            </option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 col-12 form-group">
                <button type="button" class="btn btn-success add-more">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <div class="col-md-12 col-12 form-group initial-test-list">

                <!-- item start -->
                <div class="row item-row">

                    <div class="col-md-6 col-12">
                        <label>Initial Test</label>
                        <select class="form-control select2" name="initial_test_id[]">
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




