<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ $appoinment->appoinment_no }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('doctor.appoinment.note',$appoinment->id) }}">
        @csrf
        <div class="row">

            <!-- note -->
            <div class="col-md-12 form-group">
                <label>Note</label>
                <textarea name="note" rows="3" class="form-control"></textarea>
            </div>

            <!-- date -->
            <div class="col-md-12 form-group">
                <label>Appoinment Date</label>
                <input type="date" name="appoinment_date" value="{{ $appoinment->appoinment_date }}" class="form-control">
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Add Note
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