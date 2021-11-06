<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Appoinment Initial Test</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('medical.assistant.appoinment.initial.test.edit',$appoinment_initial_test->id) }}">
        @csrf
        <div class="row">

            <div class="col-md-12 col-12 form-group initial-test-list">

                <!-- item start -->
                <div class="row item-row">

                    <div class="col-md-6 col-12">
                        <label>Initial Test</label>
                        <select class="form-control select2" name="initial_test_id">
                            @foreach( $initial_tests as $initial_test )
                            <option value="{{ $initial_test->id }}"
                            @if( $appoinment_initial_test->initial_test_id == $initial_test->id ) selected @endif 
                            >{{ $initial_test->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 col-12">
                        <label>Test Result</label>
                        <input type="text" class="form-control" name="test_value" value="{{ $appoinment_initial_test->value }}">
                    </div>


                </div>
                <!-- item end -->

            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Save
                </button>
            </div>

        </div>
    </form>

</div>
<div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>




<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">

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

