<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Doctor</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('doctor.add') }}">
        @csrf
        <div class="row">

            <!-- name -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" >
            </div>

            <!-- Type -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">Type</label>
                <select class="form-control select2"name="charge_id">
                    @foreach( $charges as $charge )
                    <option value="{{ $charge->id }}" >{{ $charge->type }}</option>
                    @endforeach
                </select>
            </div>

            <!-- in time -->
            <div class="col-md-6 col-12 form-group">
                <label >In time</label>
                <input type="time" class="form-control" name="in">
            </div>

            <!-- out time -->
            <div class="col-md-6 col-12 form-group">
                <label >Out time</label>
                <input type="time" class="form-control" name="out">
            </div>

            <div class="col-md-12 col-12 form-group">
                <label>Working Days</label>
                <select class="form-control select2" multiple name="day_id[]">
                    @foreach( $days as $day )
                    <option value="{{ $day->id }}" >{{ $day->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- designation -->
            <div class="col-md-12 col-12 form-group">
                <label for="designation">Designation</label>
                <textarea class="form-control" name="designation"></textarea>
            </div>

            <!-- Degree -->
            <div class="col-md-6 col-12 form-group">
                <label >Degree</label>
                <input type="text" class="form-control" name="degree">
            </div>

            <!-- Any Speciality ( Optional ) -->
            <div class="col-md-6 col-12 form-group">
                <label >Any Speciality ( Optional )</label>
                <input type="text" class="form-control" name="speciality">
            </div>

            <!-- Nid Card ( Optional ) -->
            <div class="col-md-12 col-12 form-group">
                <label >Nid Card ( Optional )</label>
                <input type="number" class="form-control" name="nid">
            </div>

            <!-- chamber -->
            <div class="col-md-6 col-12 form-group">
                <label >Chamber Name</label>
                <input type="text" class="form-control" name="chamber">
            </div>

            <!-- location -->
            <div class="col-md-6 col-12 form-group">
                <label >Chamber Location</label>
                <input type="text" class="form-control" name="location">
            </div>

            <!-- email -->
            <div class="col-md-6 col-12 form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email">
            </div>

            <!-- phone number -->
            <div class="col-md-6 col-12 form-group">
                <label for="phone">Phone</label>
                <input id="phone" type="text" class="form-control" name="phone">
            </div>

            <!-- confirm password -->
            <div class="col-md-6 col-12 form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <!-- confirm password -->
            <div class="col-md-6 col-12 form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>

            <!-- gender -->
            <div class="col-md-12 col-12 form-group">
                <label>Gender</label>
                <select class="form-control" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
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


<link rel="stylesheet" href="{{ asset('backend/css/rich_text_editor/rte_theme_default.css') }}">
<script src="{{ asset('backend/js/rich_text_editor/all_pluggins.js') }}"></script>
<script src="{{ asset('backend/js/rich_text_editor/rte.js') }}"></script>
<script>
    var editor1 = new RichTextEditor(".div_editor1");
    var editor2 = new RichTextEditor(".div_editor2");
</script>


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
            dropdownParent: $('#largeModal')
        });
    });
</script>



