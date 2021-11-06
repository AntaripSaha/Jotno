<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ $charge->type }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('charge.edit',$charge->id) }}">
        @csrf
        <div class="row">

            <!-- type -->
            <div class="col-md-12 col-12 form-group">
                <label>Doctor Type</label>
                <input type="text" class="form-control" name="type" value="{{ $charge->type }}">
            </div>

            <!-- Amount -->
            <div class="col-md-12 col-12 form-group">
                <label>Amount</label>
                <input type="number" class="form-control" name="amount" value="{{ $charge->amount }}">
            </div>

            <!-- status -->
            <div class="col-md-12 col-12 form-group">
                <label>Status</label>
                <select class="form-control select2" name="is_active">
                    <option value="1" @if( $charge->is_active == true ) selected @endif >Active</option>
                    <option value="0" @if( $charge->is_active == false ) selected @endif >Inactive</option>
                </select>
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Update
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