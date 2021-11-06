<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Medical Assistant</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('medical_assistant.update', $medical_assistant->id) }}">
        @csrf

        <div class="row">
            <!-- name -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $medical_assistant->name }}">
            </div>

            <!-- email -->
            <div class="col-md-6 col-12 form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $medical_assistant->email }}">
            </div>

            <!-- phone number -->
            <div class="col-md-6 col-12 form-group">
                <label for="phone">Phone</label>
                <input id="phone" type="text" class="form-control" name="phone" value="{{ $medical_assistant->phone }}">
            </div>

            <!-- Present Address -->
            <div class="col-md-6 col-12 form-group">
                <label>Present Address</label>
                <input type="text" class="form-control" name="present_address" value="{{ $medical_assistant->present_address }}" >
            </div>

            <!-- Permanent Address -->
            <div class="col-md-6 col-12 form-group">
                <label>Permanent Address</label>
                <input type="text" class="form-control" name="permanent_address" value="{{ $medical_assistant->permanent_address }}" >
            </div>

            <!-- Nid -->
            <div class="col-md-6 col-12 form-group">
                <label>NID</label>
                <input type="number" class="form-control" name="nid" value="{{ $medical_assistant->nid }}" >
            </div>

            <!-- BMDC Registration Number -->
            <div class="col-md-6 col-12 form-group">
                <label>BMDC Registration Number</label>
                <input type="number" class="form-control" name="bmdc_reg_no" value="{{ $medical_assistant->bmdc_reg_no }}" >
            </div>

            <div class="col-md-12 col-12 form-group">
                <label>Status</label>
                <select class="form-control select2" name="is_active">
                    <option value="1" @if( $medical_assistant->is_active == true ) selected @endif >Active</option>
                    <option value="0" @if( $medical_assistant->is_active == false ) selected @endif >Inactive</option>
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